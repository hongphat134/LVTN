<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NguoiTimViec;
use App\HoSoXinViec;
use App\NhaTuyenDung;
use App\TinTuyenDung;
use App\YKien;
use Auth;
use Mail;
use DB;
use App\Mail\Applied;
use App\User;
// include base_path()."/app/Function/functions.php";

class NguoiTimViecController extends Controller
{
    //
    public function getProfiles(){        
        $profile_list = NguoiTimViec::where('idUser','=',Auth::user()->id)->paginate(6);
        $profile_list->typeRecord = 0;
        // dd($profile_list);       
        return view('nguoitimviec.profile-listings',compact('profile_list'));
    }
    public function getApply($ttd_id){
        $hoso = NguoiTimViec::where('idUser','=',Auth::user()->id)->first();
        // var_dump($hoso);
        // Kiểm tra phòng thờ nếu đã nộp thì chuyển về Home
        $profile = HoSoXinViec::where([
                        ['idUser','=',Auth::user()->id],
                        ['idTTD','=',$ttd_id],
                    ]) 
                    ->first();
        if(!empty($profile)) return redirect('/');

    	return view('nguoitimviec.apply',compact('ttd_id'));
    }

    public function postApply(Request $rq,$ttd_id){
        // Problem: chưa giải quyết withInput 
        $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng                
                'email' => 'required|email',
                'name' => 'required',
                'title' => 'required',
                'skill' => 'required',
                'exp' => 'required',
                'degree' => 'required',
                'rank' => 'required',
                'region' => 'required',

            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'email.required' => 'Bạn chưa nhập Email!',
                'name.required' => 'Bạn chưa nhập họ tên!',
                'skill.required' => 'Bạn chưa chọn kĩ năng!',
                'exp.required' => 'Bạn chưa chọn số năm kinh nghiệm!',
                'email.email' => 'Email không đúng định dạng!',
                'title.required' => 'Bạn chưa nhập ngành nghề!',
                'degree.required' => 'Bạn chưa chọn bằng cấp!',
                'rank.required' => 'Bạn chưa chọn cấp bậc!',            
                'region.required' => 'Bạn chưa chọn khu vực!',
            ]
        );      
       
        $profile = new HoSoXinViec;   

        $profile->idUser = Auth::user()->id;            
        $profile->idTTD = $ttd_id;            
                                  
        $skills = json_encode($rq->skill);
        $profile->hoten = $rq->name;
        $profile->kinang = $skills;
        $profile->emaillienhe = $rq->email;
        $profile->nganh = $rq->title;
        $profile->khuvuc = $rq->region;
        $profile->kinhnghiem = $rq->exp;
        $profile->honnhan = $rq->marital_stt;       
        $profile->trangthailv = $rq->status;
        $profile->bangcap = $rq->degree;
        $profile->capbac = $rq->rank;
        $profile->mucluongmm = $rq->salary;
        $profile->muctieu = $rq->target;    
        $profile->sotruong = $rq->talent;
        $profile->remember_token = $rq->_token;

        if($rq->title != 'other') $profile->nganh = $rq->title;
        else{            
            if(empty($rq->other_title))
             return redirect()->back()->with(['error' => 'Bạn chưa điền ngành nghề khác!'])->withInput();
            else{
                $profile->nganh = perfect_trim($rq->other_title);
                // Bỏ vào table đóng góp ý kiến
                $opinion = new YKien;
                $opinion->ten = $profile->nganh;
                $opinion->loai = "ngành";
                $opinion->save();
            }
        }

        if(!empty($rq->language)){
            $languages = $rq->language;
            if(in_array('other', $languages)){
                // Bỏ mục other
                array_pop($languages);
                if(!empty($rq->other_language)){                
                    $other_languages = explode(',',$rq->other_language);
                    // Chuẩn hoá giá trị của mảng
                    $other_languages = array_map('perfect_trim', $other_languages);
                    
                    $profile->ngoaingu = json_encode(array_merge($languages,$other_languages),JSON_UNESCAPED_UNICODE);
                }
                else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
            }
            else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
        }        
        
        if(!empty($rq->itech)){
            $itechs = $rq->itech;
            if(in_array('other', $itechs)){
                array_pop($itechs);
                if(!empty($rq->other_itech)){                
                    $other_itechs = explode(',',$rq->other_itech);
                    $other_itechs = array_map('perfect_trim', $other_itechs);
                   
                    $profile->tinhoc = json_encode(array_merge($itechs,$other_itechs),JSON_UNESCAPED_UNICODE);
                }
                else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
            }
            else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
        }
                        
        $profile->save();

        return redirect()->route('notification')->with(['alert' => 'Nộp đơn thành công!']);
    }

    public function getCreateProfile(){    	
    	return view('nguoitimviec.create-profile');
    }
    
    public function postCreateProfile(Request $rq){    	        
        // dd($rq->all());
        // Problem: chưa giải quyết withInput
    	$this->validate($rq, 
			[
				//Kiểm tra giá trị rỗng
                'public' => 'required',
				'email' => 'required|email',            
                'name' => 'required',
				'title' => 'required',                
                'skill' => 'required',
                'exp' => 'required',
				'degree' => 'required',
				'rank' => 'required',
				'region' => 'required',   
			],			
			[
				//Tùy chỉnh hiển thị thông báo
                'public.required' => 'Bạn chưa chọn chế độ công khai!',
				'email.required' => 'Bạn chưa nhập Email!',
                'name.required' => 'Bạn chưa nhập họ tên!',
                'skill.required' => 'Bạn chưa chọn kĩ năng!',
                'exp.required' => 'Bạn chưa chọn số năm kinh nghiệm!',
				'email.email' => 'Email không đúng định dạng!',
				'title.required' => 'Bạn chưa chọn ngành nghề!',
				'degree.required' => 'Bạn chưa chọn bằng cấp!',
				'rank.required' => 'Bạn chưa chọn cấp bậc!',			
				'region.required' => 'Bạn chưa chọn khu vực!',
			]
		);
    	
		$profile = new NguoiTimViec;	
		$profile->idUser = Auth::user()->id;  	    	
    	  		   
    	// Xử lý file hình đại diện
    	if($rq->hasFile('hinhthe')){
    		$this->validate($rq, 
				[
					//Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
					'hinhthe' => 'mimes:jpg,jpeg,png,gif|max:2048',
				],			
				[
					//Tùy chỉnh hiển thị thông báo không thõa điều kiện
					'hinhthe.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
					'hinhthe.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
				]
			);

			//Lưu hình ảnh vào thư mục public/upload/hinhthe
			$hinhthe = $rq->file('hinhthe');
			$gethinhthe = time().'_'.$hinhthe->getClientOriginalName();
			$destinationPath = public_path('hinhdaidien');
			$hinhthe->move($destinationPath, $gethinhthe);
			// Xoá hình cũ
    		$file_anh = $profile->hinh;
    		if(!empty($file_anh)) unlink(public_path('hinhdaidien/'.$file_anh));
			$profile->hinh = $gethinhthe;
    	}    	
		// Nếu k có hình thì để hình mặc định
        $skills = json_encode($rq->skill,JSON_UNESCAPED_UNICODE);
        // Chuẩn hoá chuỗi -> chuỗi thường -> đầu từ viết Hoa
        $profile->hoten = perfect_trim($rq->name);
    	$profile->kinang = $skills;
    	$profile->emaillienhe = $rq->email;
    	
    	$profile->khuvuc = $rq->region;
        $profile->kinhnghiem = $rq->exp;
    	$profile->honnhan = $rq->marital_stt;    	
    	$profile->trangthailv = $rq->status;
    	$profile->bangcap = $rq->degree;
    	$profile->capbac = $rq->rank;
        $profile->mucluongmm = $rq->salary;
        $profile->remember_token = $rq->_token;        
        
        $profile->muctieu = $rq->target;    
        $profile->sotruong = $rq->talent;
        // echo '<pre>'.htmlentities($profile->sotruong).'</pre>';                

        if($rq->title != 'other') $profile->nganh = $rq->title;
        else{            
            if(empty($rq->other_title))
             return redirect()->back()->with(['error' => 'Bạn chưa điền ngành nghề khác!'])->withInput();
            else{
                $profile->nganh = perfect_trim($rq->other_title);
                // Bỏ vào table đóng góp ý kiến
                $opinion = new YKien;
                $opinion->ten = $profile->nganh;
                $opinion->loai = "ngành";
                $opinion->save();
            }
        }

        if(!empty($rq->language)){
            $languages = $rq->language;
            if(in_array('other', $languages)){
                // Bỏ mục other
                array_pop($languages);
                if(!empty($rq->other_language)){                
                    $other_languages = explode(',',$rq->other_language);
                    // Chuẩn hoá giá trị của mảng
                    $other_languages = array_map('perfect_trim', $other_languages);
                    
                    $profile->ngoaingu = json_encode(array_merge($languages,$other_languages),JSON_UNESCAPED_UNICODE);
                }
                else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
            }
            else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
        }        
        
        if(!empty($rq->itech)){
            $itechs = $rq->itech;
            if(in_array('other', $itechs)){
                array_pop($itechs);
                if(!empty($rq->other_itech)){                
                    $other_itechs = explode(',',$rq->other_itech);
                    $other_itechs = array_map('perfect_trim', $other_itechs);
                   
                    $profile->tinhoc = json_encode(array_merge($itechs,$other_itechs),JSON_UNESCAPED_UNICODE);
                }
                else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
            }
            else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
        }                        

    	// 0 là chưa công khai, 1 là công khai
        $profile->congkhai = $rq->public;
        // 0 là chưa dc quản trị viên phê duyệt và 1 thì ngược lại
    	// $profile->trangthai = 0;
        
    	// dd($profile);
    	$profile->save();

        return redirect()->action(
            'NguoiTimViecController@getUpdateProfile',['profile_id' => $profile->id] 
        );
    }

    public function getUpdateProfile($profile_id){     
        // Problem: chưa xử lý hình, mục khác chưa hiện dc
        $hoso = NguoiTimViec::find($profile_id);
        // dd($hoso);
        // Kiểm tra đề phòng        
        if(!$hoso || $hoso->trangthai == 1) return response()->json(['error' => 'Deny Access!','URL' => 'Invalid URL!']);
    
        return view('nguoitimviec.update-profile',compact('hoso'));
    }

    public function postUpdateProfile($profile_id,Request $rq){     
        // Problem: chưa giải quyết withInput 
        $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng
                'email' => 'required|email',
                'public' => 'required',
                'name' => 'required',
                'title' => 'required',
                'skill' => 'required',
                'exp' => 'required',
                'degree' => 'required',
                'rank' => 'required',
                'region' => 'required',   
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'email.required' => 'Bạn chưa nhập Email!',
                'public.required' => 'Bạn chưa chọn chế độ công khai!',
                'name.required' => 'Bạn chưa nhập họ tên!',
                'skill.required' => 'Bạn chưa chọn kĩ năng!',
                'exp.required' => 'Bạn chưa chọn số năm kinh nghiệm!',
                'email.email' => 'Email không đúng định dạng!',
                'title.required' => 'Bạn chưa nhập ngành nghề!',
                'degree.required' => 'Bạn chưa chọn bằng cấp!',
                'rank.required' => 'Bạn chưa chọn cấp bậc!',            
                'region.required' => 'Bạn chưa chọn khu vực!',
            ]
        );
        $profile = NguoiTimViec::find($profile_id);        

        // Xử lý file hình đại diện
        if($rq->hasFile('hinhthe')){
            $this->validate($rq, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'hinhthe' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'hinhthe.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'hinhthe.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Lưu hình ảnh vào thư mục public/upload/hinhthe
            $hinhthe = $rq->file('hinhthe');
            $gethinhthe = time().'_'.$hinhthe->getClientOriginalName();
            $destinationPath = public_path('hinhdaidien');
            $hinhthe->move($destinationPath, $gethinhthe);
            // Xoá hình cũ
            $file_anh = $profile->hinh;
            if(!empty($file_anh)) unlink(public_path('hinhdaidien/'.$file_anh));
            $profile->hinh = $gethinhthe;
        }       
        // Nếu k có hình thì để hình mặc định
        $skills = json_encode($rq->skill);
        $profile->hoten = $rq->name;
        $profile->kinang = $skills;
        $profile->emaillienhe = $rq->email;
        $profile->nganh = $rq->title;
        $profile->khuvuc = $rq->region;
        $profile->kinhnghiem = $rq->exp;
        $profile->honnhan = $rq->marital_stt;       
        $profile->trangthailv = $rq->status;
        $profile->bangcap = $rq->degree;
        $profile->capbac = $rq->rank;
        $profile->mucluongmm = $rq->salary;
        $profile->remember_token = $rq->_token;

        $profile->muctieu = $rq->target;    
        $profile->sotruong = $rq->talent;

        if($rq->title != 'other') $profile->nganh = $rq->title;
        else{            
            if(empty($rq->other_title))
             return redirect()->back()->with(['error' => 'Bạn chưa điền ngành nghề khác!'])->withInput();
            else{
                $profile->nganh = perfect_trim($rq->other_title);
                // Bỏ vào table đóng góp ý kiến
                $opinion = new YKien;
                $opinion->ten = $profile->nganh;
                $opinion->loai = "ngành";
                $opinion->save();
            }
        }

        if(!empty($rq->language)){
            $languages = $rq->language;
            if(in_array('other', $languages)){
                // Bỏ mục other
                array_pop($languages);
                if(!empty($rq->other_language)){                
                    $other_languages = explode(',',$rq->other_language);
                    // Chuẩn hoá giá trị của mảng
                    $other_languages = array_map('perfect_trim', $other_languages);
                    
                    $profile->ngoaingu = json_encode(array_merge($languages,$other_languages),JSON_UNESCAPED_UNICODE);
                }
                else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
            }
            else $profile->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
        }        
        
        if(!empty($rq->itech)){
            $itechs = $rq->itech;
            if(in_array('other', $itechs)){
                array_pop($itechs);
                if(!empty($rq->other_itech)){                
                    $other_itechs = explode(',',$rq->other_itech);
                    $other_itechs = array_map('perfect_trim', $other_itechs);
                   
                    $profile->tinhoc = json_encode(array_merge($itechs,$other_itechs),JSON_UNESCAPED_UNICODE);
                }
                else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
            }
            else $profile->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
        }              

        // 0 là chưa công khai, 1 là công khai
        $profile->congkhai = $rq->public;
                
        // dd($profile);
        $profile->update();

        return redirect()->action(
            'NguoiTimViecController@getUpdateProfile', $profile_id
        )
        ->with(['success' => 'Lưu thông tin hồ sơ thành công!']);
    }

    public function saveJob($news_id){        
        $follow = json_decode(Auth::user()->theodoi);

        // Nếu chưa có follow nào cả thì tạo mảng mới
        if(!is_array($follow)) $follow = array();
        // Chèn vào đầu mảng
        // Phòng trường hợp nếu có r thì k thêm nữa
        if(!in_array($news_id,$follow)) array_unshift($follow, $news_id);

        Auth::user()->theodoi = json_encode($follow);

        Auth::user()->update();
        echo "Đã thêm ttd";
    }

    public function unsaveJob($news_id){        
        $follow = json_decode(Auth::user()->theodoi);

        // Xoá phần tử trong mảng
        // Xoá dc mà auto index lại hiện lên
        // unset($follow[0]);
        $index = array_search($news_id, $follow);
        array_splice($follow, $index, 1);

        Auth::user()->theodoi = json_encode($follow);

        Auth::user()->update();
        echo "Đã bỏ theo dõi ttd";
    }

    public function getSaveJob(){
        // Problem: chưa lấy info theo thứ tự được 
        // Tin tuyển dụng bị xoá r thì s?
        $follow_list = json_decode(Auth::user()->theodoi);

        // dd($follow_list);
        if(!empty($follow_list)){
            $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
            ->whereIn('tintuyendung.id',$follow_list)->paginate(3);
            
            $job_listings->typeRecord = 1;
        }
        else $job_listings = null;
            
        return view('nguoitimviec.save-job-listings',compact('job_listings'));
    }

    public function getAppliedJob(){
        // Problem: chưa lấy info theo thứ tự được               
        $profiles = HoSoXinViec::where('idUser','=',Auth::user()->id)
                    ->select('idTTD')->get()->toArray();

        $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
        ->whereIn('tintuyendung.id',$profiles)->paginate(3);                
        // dd($job_listings);
        $job_listings->typeRecord = 1;            
        return view('nguoitimviec.applied-job-listings',compact('job_listings'));
    }

    public function deleteProfile($profile_id){
        NguoiTimViec::destroy($profile_id);

        return redirect()->back()->with(['success' => 'Đã xoá mẫu hồ sơ!']);
    }

    public function getSelectApply($news_id){        
        // Kiểm tra phòng thờ nếu đã nộp thì chuyển về Home
        $profile = HoSoXinViec::where([
                        ['idUser','=',Auth::user()->id],
                        ['idTTD','=',$news_id],
                    ])    
                    ->first();
        if(!empty($profile)) return redirect('/');
        $news = TinTuyenDung::findOrFail($news_id);
        // dd($news);
        $profiles = NguoiTimViec::where('idUser','=',Auth::user()->id)->paginate(5);
        $profiles->typeRecord = 0;        
        return view('nguoitimviec.select-apply',compact('profiles','news'));
    }

    public function apply(Request $rq){
        
        if(empty($rq->profile)) return redirect()->back()->with(['error' => 'Bạn chưa chọn hồ sơ để thao tác!']);

        if(isset($rq->copy)){
            $profile = NguoiTimViec::find($rq->profile);
            return view('nguoitimviec.copy-apply',['ttd_id' => $rq->ttd_id,'hoso' => $profile]);  
        } 
        $profile_id = $rq->profile;
        
        $profile = NguoiTimViec::find($profile_id);
        // dd($profile);
        $apply_profile = new HoSoXinViec;

        $apply_profile->idUser = $profile->idUser;
        $apply_profile->idTTD = (int)$rq->ttd_id;

        $apply_profile->hoten = $profile->hoten;
        $apply_profile->emaillienhe = $profile->emaillienhe;
        $apply_profile->nganh = $profile->nganh;
        $apply_profile->kinang = $profile->kinang;
        $apply_profile->khuvuc = $profile->khuvuc;
        $apply_profile->honnhan = $profile->honnhan;
        $apply_profile->trangthailv = $profile->trangthailv;
        $apply_profile->bangcap = $profile->bangcap;
        $apply_profile->capbac = $profile->capbac;
        $apply_profile->kinhnghiem = $profile->kinhnghiem;
        $apply_profile->mucluongmm = $profile->mucluongmm;        
        $apply_profile->ad_pheduyet = $profile->ad_pheduyet;
        $apply_profile->ngoaingu = $profile->ngoaingu;
        $apply_profile->tinhoc = $profile->tinhoc;
        $apply_profile->sotruong = $profile->ngosotruongaingu;
        $apply_profile->muctieu = $profile->muctieu;

        $apply_profile->remember_token = $profile->remember_token;             
        $apply_profile->save();
        // Mẫu hồ sơ đã được duyệt thì khi nộp sẽ đưa đến tay nhà tuyển dụng
        if($profile->ad_pheduyet == 1){
            // Gửi mail => Pải xác định danh tính Nhà tuyển dụng
            $ntd = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->select('nhatuyendung.idUser')
                ->get()->first();
            $to_email = User::find($ntd->idUser)->email; 
            dd($to_email);
            Mail::send(new Applied($to_email));
        }
        return redirect()->route('notification')->with(['alert' => 'Nộp đơn thành công!']);
    }

    public function setStatus($profile_id){
        $profile = NguoiTimViec::find($profile_id);

        $profile->congkhai = ($profile->congkhai == 0) ? 1 : 0;

        $profile->update();

        return redirect()->back()->with(['success' => "Đổi trạng thái mẫu hồ sơ \"$profile->nganh\" thành công!"]);
    }

    public function getFollowRecruiter(){
        $ntd_list = NhaTuyenDung::paginate(2)->fragment('next');
        $ntd_list->typeRecord = 2;
        // Xử lý follow
        $follows = Auth::user()->theodoi_ntd;
        if($follows){
            $follows = json_decode($follows);
            $f_ntd_list =  NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->where('tintuyendung.ad_pheduyet',1)
                ->whereIn('idUser',$follows)
                ->select('nhatuyendung.idUser','nhatuyendung.ten',DB::raw("COUNT(tintuyendung.id) as count"))
                ->groupBy('nhatuyendung.idUser','nhatuyendung.ten')
                ->get();
            return view('nguoitimviec.follow-recruiters',compact('ntd_list','f_ntd_list'));
        }
        return view('nguoitimviec.follow-recruiters',compact('ntd_list'));
    }

    public function searchByRecruiter(Request $rq){
        // dd($rq->all());
        $key = $rq->key;
        $ntd_list = NhaTuyenDung::where('ten','LIKE',"%$key%")->paginate(9);
        $follows = Auth::user()->theodoi_ntd;
        if($follows){
            $follows = json_decode($follows);
            $f_ntd_list =  NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                // ->where('tintuyendung.new',1)
                ->where('tintuyendung.ad_pheduyet',1)
                ->whereIn('idUser',$follows)
                ->select('nhatuyendung.idUser','nhatuyendung.ten',DB::raw("COUNT(tintuyendung.id) as count"))
                ->groupBy('nhatuyendung.idUser','nhatuyendung.ten')
                ->get();
            return view('nguoitimviec.follow-recruiters',compact('ntd_list','f_ntd_list','key'));
        }        
        return view('nguoitimviec.follow-recruiters',compact('ntd_list','key'));
    }

    public function saveRecuiter($rec_id){        
        $follow = json_decode(Auth::user()->theodoi_ntd);

        // Nếu chưa có follow nào cả thì tạo mảng mới
        if(!is_array($follow)) $follow = array();
        // Chèn vào đầu mảng
        // Phòng trường hợp nếu có r thì k thêm nữa
        if(!in_array($rec_id,$follow)) array_unshift($follow, $rec_id);

        Auth::user()->theodoi_ntd = json_encode($follow);

        Auth::user()->update();
        // return  Auth::user()->theodoi_add;
        echo "Đã theo dõi ntd";    
    }

    public function unsaveRecuiter($rec_id){        
        $follow = json_decode(Auth::user()->theodoi_ntd);

        $index = array_search($rec_id, $follow);
        array_splice($follow, $index, 1);

        Auth::user()->theodoi_ntd = !empty($follow) ? json_encode($follow) : null;

        Auth::user()->update();
        echo "Đã bỏ theo dõi ntd";
    }

    public function notifyJobs(){
        return view('nguoitimviec.notify-jobs');
    }
}