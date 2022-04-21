<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuyenDung;
use App\NhaTuyenDung;
use App\NguoiTimViec;
use App\HoSoXinViec;
use App\User;
use App\YKien;
use App\Mail\OfferSeeker;
use App\Mail\CancelJob;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Mail as FacadesMail;

// include base_path()."/app/Function/functions.php";

class NhaTuyenDungController extends Controller
{
    //
    public function index(){    	
        $profile_list = NguoiTimViec::where('congkhai','=','1')
                ->where('ad_pheduyet','=',1)->get();
        if($profile_list->count() > 15) $profile_list = $profile_list->random(15);
        $profile_list->typeRecord = 0;
        // dd($profile_list);
    	return view('nhatuyendung.home',compact('profile_list'));
    }

    public function getProfiles(){
        $profile_list = NguoiTimViec::where('congkhai','=','1')
                ->where('ad_pheduyet','=',1)->paginate(10)->fragment('content');
        $profile_list->typeRecord = 0;
        // dd($profile_list);

        return view('nhatuyendung.profile-listings',compact('profile_list'));
    }

    public function getPostJob(){
        $user = NhaTuyenDung::where('idUser',Auth::user()->id)->get()->first();
        // dd($user);
    	return view('nhatuyendung.post-job',compact('user'));
    }

    public function postPostJob(Request $rq){
        // dd($rq->all());    	
    	$validator = $this->validate($rq, 
			[
				//Kiểm tra giá trị rỗng
                'deadline' => 'required',
                'vacancy' => 'required',
                'skill' => 'required',
				'job' => 'required',
				'degree' => 'required',
                'rank' => 'required',
                'exp' => 'required',
				'salary' => 'required',
				'region' => 'required',                              
			],			
			[
				//Tùy chỉnh hiển thị thông báo
                'deadline.required' => 'Bạn chưa chọn hạn tuyển dụng!',
				'job.required' => 'Bạn chưa chọn ngành nghề!',
				'skill.required' => 'Bạn chưa chọn kĩ năng!',	
                'degree.required' => 'Bạn chưa chọn yêu cầu bằng cấp!',   
                'rank.required' => 'Bạn chưa chọn yêu cầu vị trí!',
				'salary.required' => 'Bạn chưa chọn mức lương!',
				'vacancy.required' => 'Bạn chưa nhập số lượng!',
				'exp.required' => 'Bạn chưa chọn yêu cầu kinh nghiệm!',			
				'region.required' => 'Bạn chưa chọn khu vực!',                
			]
		);

        if($validator != null){
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput($rq);
            }    
        }
        // Hạn tuyển dụng phải sau ngày hiện tại?
        if($rq->deadline <= date('Y-m-d')) return redirect()->back()->with(['errorDate' => 'Hạn tuyển dụng phải sau ngày hiện tại!'])->withInput();        

        // kĩ năng, khu vực chuyển thành JSON
    	$skill = json_encode($rq->skill,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $region = json_encode($rq->region,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

    	$news = new TinTuyenDung;
    	
    	$news->kinang = $skill;
        $news->tinhthanhpho = $region;

    	$news->nganh = $rq->job;
        $news->bangcap = $rq->degree;
        $news->capbac = $rq->rank;
    	$news->mucluong = $rq->salary;
    	$news->soluong = $rq->vacancy;
        $news->tg_thuviec = $rq->probation;
    	$news->hinhthuc_lv = $rq->status;
    	$news->gioitinh = $rq->gender;
    	$news->kinhnghiem = $rq->exp;
    	$news->remember_token = $rq->_token;
    	$news->idNTD = Auth::user()->id;
        
        $news->hantuyendung = $rq->deadline;
        // $news->yeucau_cv = $rq->plus;
        // Các trường mới        
        // array_filter(array) => lọc các giá trị null trong mảng nhưng giữ nguyên key        
        // $result = array_filter($rq->des_job);
        // array_values(input) => set key lại mặc định (0,1,2,3,...)
        // $result = array_values($result);
        // var_dump($result);

        if($rq->job != 'other') $news->nganh = $rq->job;
        else{            
            if(empty($rq->other_title))
             return redirect()->back()->with(['errorJob' => 'Bạn chưa điền ngành nghề khác!'])->withInput();
            else{
                $news->nganh = perfect_trim($rq->other_title);
                // Bỏ vào table đóng góp ý kiến
                $opinion = new YKien;
                $opinion->ten = $news->nganh;
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
                    
                    $news->ngoaingu = json_encode(array_merge($languages,$other_languages),JSON_UNESCAPED_UNICODE);
                }
                else $news->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
            }
            else $news->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
        }        
        
        if(!empty($rq->itech)){
            $itechs = $rq->itech;
            if(in_array('other', $itechs)){
                array_pop($itechs);
                if(!empty($rq->other_itech)){                
                    $other_itechs = explode(',',$rq->other_itech);
                    $other_itechs = array_map('perfect_trim', $other_itechs);
                   
                    $news->tinhoc = json_encode(array_merge($itechs,$other_itechs),JSON_UNESCAPED_UNICODE);
                }
                else $news->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
            }
            else $news->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
        }


        if($rq->des_job = array_values(array_filter($rq->des_job))){         
            $news->motacv = json_encode($rq->des_job,JSON_UNESCAPED_UNICODE);
        }  
        if($rq->benefit = array_values(array_filter($rq->benefit))){         
            $news->quyenloi = json_encode($rq->benefit,JSON_UNESCAPED_UNICODE);
        }
        if($rq->info_contact = array_values(array_filter($rq->info_contact))){         
            $news->ttlienhe = json_encode($rq->info_contact,JSON_UNESCAPED_UNICODE);
        }   
        if($rq->info_plus = array_values(array_filter($rq->info_plus))){         
            $news->yeucau_cv = json_encode($rq->info_plus,JSON_UNESCAPED_UNICODE);
        }    
       
    	$news->save();        
    	return redirect()->route('updateJob',$news->id)->with(['success' => 'Lưu thành công!']);
    }

    public function getUpdateJob($news_id){
    	$news = TinTuyenDung::find($news_id);
        // Kiểm tra phòng thờ
        if($news == null) return redirect('/error')->with(['error' => 'Lỗi tìm kiếm tin tuyển dụng!']);      
        // Biến chuỗi json kĩ năng thành mảng
        $news->kinang = json_decode($news->kinang);
        // dd($news);
        return view('nhatuyendung.update-job',compact('news'));
    }

    public function postUpdateJob(Request $rq,$news_id){        
        $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng    
                'deadline' => 'required',            
                'skill' => 'required',                
                'vacancy' => 'required',
                'region' => 'required',                
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'deadline.required' => 'Bạn đừng để trống hạn tuyển dụng!',
                'skill.required' => 'Không để trống kĩ năng bạn nhé!',
                'vacancy.required' => 'Không để trống số lượng bạn nhé!',
                'region.required' => 'Không đế trống khu vực bạn nhé!',
            ]
        );

        // Hạn tuyển dụng phải sau ngày hiện tại?
        if($rq->deadline <= date('Y-m-d')) return redirect()->back()->with(['error' => 'Hạn tuyển dụng phải sau ngày hiện tại!'])->withInput();      

        $skill = json_encode($rq->skill,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $region = json_encode($rq->region,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        $news = TinTuyenDung::find($news_id);
        // SKill chuyển thành JSON
        $news->kinang = $skill;
        $news->tinhthanhpho = $region;
        
        $news->mucluong = $rq->salary;
        $news->soluong = $rq->vacancy;
        $news->bangcap = $rq->degree;
        $news->capbac = $rq->rank;
        $news->hinhthuc_lv = $rq->status;
        $news->gioitinh = $rq->gender;
        $news->kinhnghiem = $rq->exp;
        $news->tg_thuviec = $rq->probation;
        $news->remember_token = $rq->_token;  

        $news->hantuyendung = $rq->deadline;

        if($rq->job != 'other') $news->nganh = $rq->job;
        else{            
            if(empty($rq->other_title))
             return redirect()->back()->with(['errorJob' => 'Bạn chưa điền ngành nghề khác!'])->withInput();
            else{
                $news->nganh = perfect_trim($rq->other_title);
                // Bỏ vào table đóng góp ý kiến
                $opinion = new YKien;
                $opinion->ten = $news->nganh;
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
                    
                    $news->ngoaingu = json_encode(array_merge($languages,$other_languages),JSON_UNESCAPED_UNICODE);
                }
                else $news->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
            }
            else $news->ngoaingu = json_encode($languages,JSON_UNESCAPED_UNICODE);
        }        
        
        if(!empty($rq->itech)){
            $itechs = $rq->itech;
            if(in_array('other', $itechs)){
                array_pop($itechs);
                if(!empty($rq->other_itech)){                
                    $other_itechs = explode(',',$rq->other_itech);
                    $other_itechs = array_map('perfect_trim', $other_itechs);
                   
                    $news->tinhoc = json_encode(array_merge($itechs,$other_itechs),JSON_UNESCAPED_UNICODE);
                }
                else $news->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
            }
            else $news->tinhoc = json_encode($itechs,JSON_UNESCAPED_UNICODE);
        }

        if($rq->des_job = array_values(array_filter($rq->des_job))){         
            $news->motacv = json_encode($rq->des_job,JSON_UNESCAPED_UNICODE);
        }  
        if($rq->benefit = array_values(array_filter($rq->benefit))){         
            $news->quyenloi = json_encode($rq->benefit,JSON_UNESCAPED_UNICODE);
        }
        if($rq->info_contact = array_values(array_filter($rq->info_contact))){         
            $news->ttlienhe = json_encode($rq->info_contact,JSON_UNESCAPED_UNICODE);
        }      
        if($rq->info_plus = array_values(array_filter($rq->info_plus))){         
            $news->yeucau_cv = json_encode($rq->info_plus,JSON_UNESCAPED_UNICODE);
        }           

        $news->ad_pheduyet = 0;
        $news->update();
        
        return redirect()->back()->with(['success' => 'Lưu thành công!']);
    }

    public function getJobList(){    	
        $job_listings = TinTuyenDung::where('idNTD',Auth::user()->id)                
                ->whereDate('hantuyendung','>',date('Y-m-d H:i:s'))
                ->get();
        // Tính hồ sơ chờ duyệt và đã xử lý       
        foreach ($job_listings as $job) {
            $numsOfUnapproved = 0;
            $numsOfApproved = 0;
            $numsOfUnapproved = HoSoXinViec::where('idTTD',$job->id)->where('ad_pheduyet',1)->where('ntd_ungtuyen',0)->count();
            $numsOfApproved = HoSoXinViec::where('idTTD',$job->id)->where('ad_pheduyet',1)->where('ntd_ungtuyen',1)->count();
            $job->hschoduyet = $numsOfUnapproved;
            $job->hsdaxuly = $numsOfApproved;
        }        
        // 0 là hồ sơ, 1 là tin tuyển dụng
        $job_listings->typeRecord = 1;
        // dd($job_listings);
    	return view('nhatuyendung.job-listings',compact('job_listings'));
    }

    public function getEditProfile(){
        $profile = NhaTuyenDung::find(Auth::user()->id);

        $scale_list = array(
                    'Dưới 20 người',
                    '20 - 150 người',
                    '150 - 300 người',
                    'Trên 300 người',                    
                );
        // dd($profile);
        return view('nhatuyendung.profile',compact('profile','scale_list'));
    }

    public function postEditProfile(Request $rq){
        $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng                
                'name' => 'required',
                'contact_name' => 'required',                
                'phone' => 'required',
                'email' => 'required|email',
                'address' => 'required',                                
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'name.required' => 'Bạn không được để trống tên nhà tuyển dụng!',
                'contact_name.required' => 'Bạn không được để trống tên người liên hệ!',   
                'phone.required' => 'Bạn không được để trống SDT liên hệ!',   
                'email.required' => 'Bạn không được để trống Email liên hệ!',   
                'email.email' => 'Bạn điền Email không đúng định dạng!',   
                'address.required' => 'Bạn không được để trống địa chỉ!',
            ]
        );
        // var_dump($rq->all());
        $profile = NhaTuyenDung::find(Auth::user()->id); 
        // Kiểm tra URL website có đúng định dạng ko?
        if($rq->website){
            $reg_url = '/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{1,5}(:[0-9]{1,5})?(\/.*)?$/';
            if(!preg_match($reg_url,$rq->website))
                return redirect()->back()->with(['error' => 'Đường dẫn website bạn nhập không hợp lệ!'])->withInput();                             
        }  
        // Xử lý file hình đại diện
        if($rq->hasFile('logo')){
            $this->validate($rq, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'logo' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'logo.mimes' => 'Chỉ chấp nhận logo với đuôi .jpg .jpeg .png .gif',
                    'logo.max' => 'Hình logo giới hạn dung lượng không quá 2M',
                ]
            );
            //Lưu hình ảnh vào thư mục public/upload/hinhthe
            $hinhthe = $rq->file('logo');
            $gethinhthe = time().'_'.$hinhthe->getClientOriginalName();
            $destinationPath = public_path('logo');
            $hinhthe->move($destinationPath, $gethinhthe);
            // Xoá hình cũ
            $file_anh = $profile->hinh;
            if(!empty($file_anh)) unlink(public_path('logo/'.$file_anh));
            $profile->hinh = $gethinhthe;
        }  
        
        $profile->ten    = $rq->name;
        $profile->sdt    = $rq->phone;
        $profile->tenlh    = $rq->contact_name;
        $profile->email    = $rq->email;
        $profile->diachi = $rq->address;
        $profile->tinhthanhpho = $rq->region;
        $profile->quymodansu = $rq->scale;
        $profile->website = $rq->website;
        $profile->remember_token = $rq->_token;  
        $profile->vanhoaphucloi  = $rq->culture;

        $profile->update();
        // CHuyển hướng
        return redirect()->back()->with(['success' => "Cập nhật thành công!"]);
    }

    public function viewProfile($profile_id){
        $profile = NguoiTimViec::find($profile_id);      
        $profile->luotxem = $profile->luotxem + 1;
        $profile->update();
        return view('nhatuyendung.profile-single',compact('profile'));
    }

    public function getSaveProfiles(){
        $follows = Auth::user()->theodoi?json_decode(Auth::user()->theodoi): [];        
        // Chưa bỏ "" trong json nên find k nhận => bỏ array vào lại dc :D
        // $profile_list = NguoiTimViec::find($follows);
        $profile_list = NguoiTimViec::whereIn('id',$follows)->paginate(6);
        
        return view('nhatuyendung.save-profile-listings',compact('profile_list'));
    }

    public function saveProfile($profile_id){
        $user = Auth::user();

        if(empty($user->theodoi)) $follows = array();
        else $follows = json_decode($user->theodoi);

        array_unshift($follows, $profile_id);

        $user->theodoi = json_encode($follows);

        $user->update();
        echo $user->theodoi;
    }

    public function unsaveProfile($profile_id){
        $user = Auth::user();
        $follows = json_decode($user->theodoi);

        $index = array_search($profile_id, $follows);
        array_splice($follows, $index, 1);
        
        $user->theodoi = !empty($follows)? json_encode($follows) : null;

        $user->update();
        echo $user->theodoi == null ? 'Rỗng' : $user->theodoi;
    }

    public function search(Request $rq){
        // dd($rq->all());
        $key = $rq->key;
        $khuvuc = $rq->region;
        $mucluong = $rq->salary;

        $profile_list = NguoiTimViec::where('congkhai',1)
                    ->where('ad_pheduyet',1)
                    ->where(function($query) use($key,$khuvuc){
                        if(!empty($key)) $query->orWhere('nganh','LIKE',"%$key%");
                        if(!empty($khuvuc)) $query->orWhereIn('khuvuc',$khuvuc);
                        if(!empty($mucluong)) $query->orWhereIn('mucluong',$mucluong);
                    });
                   
        if($rq->has('job')) $profile_list->whereIn('nguoitimviec.nganh',$rq->job);
        if($rq->has('skill')){
            $skills = $rq->skill; 
            $profile_list->where(
            function($query) use ($skills){                
                foreach ($skills as $skill) {
                    $query->orWhere('nguoitimviec.kinang','LIKE',"%\"$skill\"%");
                }                                   
            });
        }
        if($rq->has('degree')) $profile_list->where('nguoitimviec.bangcap','LIKE',$rq->degree);
        if($rq->has('rank')) $profile_list->where('nguoitimviec.capbac','LIKE',$rq->rank);
        if($rq->has('sex')) $profile_list->where('nguoitimviec.gioitinh','LIKE',$rq->sex);
        if($rq->has('status')) $profile_list->where('nguoitimviec.hinhthuc_lv','LIKE',$rq->status);
        if($rq->has('exp')) $profile_list->where('nguoitimviec.kinhnghiem','LIKE',$rq->exp);
        if($rq->has('number')) $profile_list->where('nguoitimviec.soluong','<=',$rq->number);

        $profile_list = $profile_list->take(15)->orderBy('nguoitimviec.mucluongmm')->get();
        // dd($job_listings);
        $search_info = $rq->all();                    
        $profile_list->typeRecord = 0;
        return view('nhatuyendung.search',compact('profile_list','search_info'));
    }

    public function recruit(Request $rq){
        // Lấy từ idUser    
        // dd($rq->all());
        $user_list = array();
        $job_list = array();
        foreach($rq->recCheckbox as $v){
            $info = explode(' ', $v);
            $user_list[] = $info[0];
            $job_list[] = $info[1];
        }
        // Get Mail from User
        $mail_list = array();
        foreach ($user_list as $v) {
            $user = User::find($v);
            $mail_list[] = $user->email;
        }
        // Set hồ sơ đã xử lý
        HoSoXinViec::whereIn('idUser',$user_list)
            ->whereIn('idTTD',$job_list)
            ->update([
                'ntd_ungtuyen' => 1,
                'noidung_ungtuyen' => $rq->recContent
            ]);
        
        // $mail_list = ['hongphat701@gmail.com','conbaba999990@gmail.com'];
        $recruiter = NhaTuyenDung::find(Auth::user()->id);
        $reply_to = $rq->has('recEmail') ? $rq->recEmail : Auth::user()->email;
        
        Mail::send('emails.recruited',
            ['status' => $rq->recRadio, 'content' => $rq->recContent , 'recruiter' => $recruiter],
            function ($message) use ($mail_list,$reply_to){
                $message->to(config('mail.username'))
                    ->bcc($mail_list)
                    ->replyTo($reply_to)
                    ->subject('Thông tin ứng tuyển');
            }
        );
        return redirect()->back()->with(['success' => 'Đã xử lý '.count($rq->recCheckbox).' hồ sơ!']);
    }

    public function getAppliedProfiles($job_id){
        $job = TinTuyenDung::find($job_id);
        $profile_list = HoSoXinViec::where('idTTD',$job_id)
                        ->where('ad_pheduyet',1)
                        ->where('ntd_ungtuyen',0)
                        ->get();
        
        $profile_list->typeRecord = 0;

        return view('nhatuyendung.applied-profile-listings',compact('profile_list','job'));
    }

    public function getProcessedProfiles($job_id){
        // Problem
        // Pải lưu cả thời gian xử lý, nội dung gửi đi là gì?
        $profile_list = HoSoXinViec::where('idTTD',$job_id)
                        ->where('ad_pheduyet',1)
                        ->where('ntd_ungtuyen',1)
                        ->orderBy('updated_at','desc') 
                        ->get();

        $profile_list->typeRecord = 0;
        $job = TinTuyenDung::find($job_id);
        // dd($profile_list);    
        return view('nhatuyendung.processed-profile-listings',compact('profile_list','job'));
    }

    public function deleteAppliedPrf(Request $rq){
        // dd($rq->all());
        // Lấy từ idUser
        $user_list = array();
        $job_list = array();
        foreach ($rq->recCheckbox as $v) {
            $info = explode(' ', $v);
            $user_list[] = $info[0];
            $job_list[] = $info[1];
        }
        // dd($job_list);

        $count = HoSoXinViec::whereIn('idUser',$user_list)
                ->whereIn('idTTD',$job_list)->delete();
        return redirect()->back()->with(['success' => "Xoá thành công $count hồ sơ!"]);                
    }

    public function searchByIDJob(Request $rq){
        // dd($rq->all());
        $key = $rq->key;

        $profile_list = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                        ->join('hosoxinviec','hosoxinviec.idTTD','=','tintuyendung.id')
                        ->select('hosoxinviec.*','tintuyendung.nganh as title') 
                        // ĐK để lọc hồ sơ thuộc nhà tuyển dụng nào quản lý
                        ->where('nhatuyendung.idUser','=',Auth::user()->id)                        
                        ->where('tintuyendung.ad_pheduyet',1)
                        ->where('hosoxinviec.ntd_ungtuyen',0);
                        
        if($key){
            $profile_list->where('tintuyendung.nganh','LIKE','%'.$key.'%');        
            
        }
        $profile_list = $profile_list->paginate(15)->fragment('next-section');

        $profile_list->typeRecord = 0;

        $job = TinTuyenDung::find($rq->job_id);

        return view('nhatuyendung.applied-profile-listings',compact('profile_list','key','job'));
    }

    public function offerSeeker(Request $rq){
        // dd($rq->all());
        $ntv = User::find($rq->idUser);
        // dd($ntv);
        $ntd = Auth::user();
        // dd($ntd);
        $email_ntv = $ntv->email;
        $email_reply = $rq->email;

        $email = $ntv->email;
        $name = $ntv->ten;

        Mail::send('emails.offer', 
            ['ntv' => $ntv, 'ntd' => $ntd,'content' => $rq->content], 
            function ($m) use ($email,$name,$email_reply) {          
            $m->to($email, $name)->replyTo($email_reply)->subject('Lời ngỏ ý từ Nhà tuyển dụng!');
        });

        return redirect()->route('notification')->with(['alert' => 'Bạn đã gửi lời nhắn qua E-mail đến người đăng hồ sơ này, hãy đợi phản hồi từ họ nhé!']);
    }

    public function searchSeekers($job_id){       
        $job = TinTuyenDung::find($job_id);

        $key = $job->nganh;

        $seeker_list = NguoiTimViec::where('nganh','LIKE','%'.$key.'%')->take(15)->get();

        // dd($seeker_list);
        return view('nhatuyendung.search-seekers',compact('seeker_list','job'));
    }

    public function offerManySeekers(Request $rq){
        // dd($rq->all());          
        $ntv_list = User::whereIn('id',$rq->recCheckbox)->select('email')->get();
        // dd($ntv_list->toArray());
        $ntd = NhaTuyenDung::find(Auth::user()->id)->toArray();
        $ntd['id_ttd'] = $rq->idJob;
        $ntd['vitri'] = $rq->vitri;
        // dd($ntd);
        $reply_to = $rq->has('recEmail') ? $rq->recEmail : Auth::user()->email;
        // dd($reply_to);
        Mail::send(new OfferSeeker($ntv_list,$ntd,$reply_to));
        return redirect('/nhatuyendung/jobs-list')->with(['success' => 'Đã gửi lời ngỏ ý đến '.count($rq->recCheckbox).' người tìm việc!']);
    }

    public function deleteJob($job_id){
        // dd($job_id);
        $ntd = NhaTuyenDung::find(Auth::user()->id)->select('idUser','ten')->get()->first()->toArray();
        $job = TinTuyenDung::find($job_id);
        $ntd['vitri'] = $job->nganh;
        // dd($ntd);
        // Lấy Email của những hồ sơ chưa phê duyệt
        $user_list = HoSoXinViec::where('idTTD',$job_id)->select('idUser')->get()->toArray();
        // dd($user_list);

        $email_list = User::whereIn('id',$user_list)->select('email')->get()->toArray();
        // dd($email_list);
        // Gửi Email thông báo cho họ
        if($email_list){            
             Mail::send(new CancelJob($email_list,$ntd));
        }
        // Xoá sạch hồ sơ xin việc thuộc ttd này => Đã được giải quyết nhờ ->onDelete('cascade'); :D

        // Xoá ttd này
        TinTuyenDung::destroy($job_id);        

        return redirect()->back()->with(['success' => 'Xoá tin tuyển dụng "'.$ntd['vitri'].'" thành công! Chúng tôi đã gửi thông báo đến những người tìm việc có hồ sơ chưa được xử lý!']);
    }
}