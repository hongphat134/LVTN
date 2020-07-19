<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KiNang;
use App\NganhNghe;
use App\BangCap;
use App\MucLuong;
use App\KinhNghiem;
use App\TinTuyenDung;
use App\NhaTuyenDung;
use App\NguoiTimViec;
use App\HoSoXinViec;
use Auth;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Input;

class NhaTuyenDungController extends Controller
{
    //
    public function index(){    	
        $profile_list = NguoiTimViec::where('congkhai','=','1')
                ->where('trangthai','=',1)->paginate(2)->fragment('content');       
        // dd($profile_list);
    	return view('nhatuyendung.home',compact('profile_list'));
    }

    public function getPostJob(){
    	return view('nhatuyendung.post-job');
    }

    public function postPostJob(Request $rq){
    	// Problem: chưa xử lý phần KHÁC của các select
        var_dump($rq->all());        
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
        if($rq->deadline <= date('Y-m-d')) return redirect()->back()->with(['error' => 'Hạn tuyển dụng phải sau ngày hiện tại!'])->withInput();
        // Kiểm tra URL website có đúng định dạng ko?
        if($rq->website){
            $reg_url = '/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{1,5}(:[0-9]{1,5})?(\/.*)?$/';
            if(!preg_match($reg_url,$rq->website))
                return redirect()->back()->with(['error' => 'Đường dẫn website bạn nhập không hợp lệ!'])->withInput();                             
        }

        // kĩ năng, khu vực chuyển thành JSON
    	$skill = json_encode($rq->skill);
        $region = json_encode($rq->region,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

    	$news = new TinTuyenDung;
    	
    	$news->kinang = $skill;
        $news->tinhthanhpho = $region;

    	$news->nganh = $rq->job;
        $news->bangcap = $rq->degree;
        $news->capbac = $rq->rank;
    	$news->mucluong = $rq->salary;
    	$news->soluong = $rq->vacancy;
    	$news->trangthailv = $rq->status;
    	$news->gioitinh = $rq->gender;
    	$news->kinhnghiem = $rq->exp;
    	$news->remember_token = $rq->_token;
    	$news->idNTD = Auth::user()->id;
        
        $news->hantuyendung = $rq->deadline;
        // 0 là chưa duyệt. Ngc lại, 1 là đã duyệt. Default: 0
        $news->congkhai = 0;
        // Các trường mới        
        // array_filter(array) => lọc các giá trị null trong mảng nhưng giữ nguyên key        
        // $result = array_filter($rq->des_job);
        // array_values(input) => set key lại mặc định (0,1,2,3,...)
        // $result = array_values($result);
        // var_dump($result);
        if(is_array($rq->language)) 
            $news->ngoaingu = json_encode($rq->language,JSON_UNESCAPED_UNICODE);
        if(is_array($rq->itech))
            $news->tinhoc = json_encode($rq->itech,JSON_UNESCAPED_UNICODE);

        if($rq->des_job = array_values(array_filter($rq->des_job))){         
            $news->motacv = json_encode($rq->des_job,JSON_UNESCAPED_UNICODE);
        }  
        if($rq->benefit = array_values(array_filter($rq->benefit))){         
            $news->quyenloi = json_encode($rq->benefit,JSON_UNESCAPED_UNICODE);
        }
        if($rq->info_contact = array_values(array_filter($rq->info_contact))){         
            $news->ttlienhe = json_encode($rq->info_contact,JSON_UNESCAPED_UNICODE);
        }      

        $news->website = $rq->website;        
    	$news->save();
        // dd($news);
    	return redirect()->route('updateJob',$news->id)->with(['success' => 'Lưu thành công!']);
    }

    public function getUpdateJob($news_id){
    	$news = TinTuyenDung::find($news_id);

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
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'deadline.required' => 'Bạn đừng để trống hạn tuyển dụng!',
                'skill.required' => 'Bạn chưa chọn kĩ năng!',
                'vacancy.required' => 'Bạn chưa nhập số lượng!',
            ]
        );

        // Hạn tuyển dụng phải sau ngày hiện tại?
        if($rq->deadline <= date('Y-m-d')) return redirect()->back()->with(['error' => 'Hạn tuyển dụng phải sau ngày hiện tại!'])->withInput();
        // Kiểm tra URL website có đúng định dạng ko?
        if($rq->website){
            $reg_url = '/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{1,5}(:[0-9]{1,5})?(\/.*)?$/';
            if(!preg_match($reg_url,$rq->website))
                return redirect()->back()->with(['error' => 'Đường dẫn website bạn nhập không hợp lệ!'])->withInput();                             
        }

        $skill = json_encode($rq->skill);
        $region = json_encode($rq->region);

        $news = TinTuyenDung::find($news_id);
        // SKill chuyển thành JSON
        $news->kinang = $skill;
        $news->tinhthanhpho = $region;

        $news->nganh = $rq->job;
        $news->mucluong = $rq->salary;
        $news->soluong = $rq->vacancy;
        $news->bangcap = $rq->degree;
        $news->capbac = $rq->rank;
        $news->trangthailv = $rq->status;
        $news->gioitinh = $rq->gender;
        $news->kinhnghiem = $rq->exp;
        $news->remember_token = $rq->_token;  

        $news->hantuyendung = $rq->deadline;

        if(is_array($rq->language)) 
            $news->ngoaingu = json_encode($rq->language,JSON_UNESCAPED_UNICODE);
        if(is_array($rq->itech))
            $news->tinhoc = json_encode($rq->itech,JSON_UNESCAPED_UNICODE);

        if($rq->des_job = array_values(array_filter($rq->des_job))){         
            $news->motacv = json_encode($rq->des_job,JSON_UNESCAPED_UNICODE);
        }  
        if($rq->benefit = array_values(array_filter($rq->benefit))){         
            $news->quyenloi = json_encode($rq->benefit,JSON_UNESCAPED_UNICODE);
        }
        if($rq->info_contact = array_values(array_filter($rq->info_contact))){         
            $news->ttlienhe = json_encode($rq->info_contact,JSON_UNESCAPED_UNICODE);
        }      

        $news->website = $rq->website;

        $news->update();
        
        return redirect()->back()->with(['success' => 'Lưu thành công!']);
    }

    public function getJobList(){    	
        $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->where('tintuyendung.idNTD','=',Auth::user()->id)
                ->paginate(3)->fragment('next');
    	
        // Chuyển JSON kĩ năng thành mảng
        for ($i=0; $i < count($job_listings) ; $i++) { 
            $job_listings[$i]->kinang =  json_decode($job_listings[$i]->kinang);
            $skills = array();
            for ($j=0; $j < count($job_listings[$i]->kinang) ; $j++) {                 
                $skills[] = KiNang::find($job_listings[$i]->kinang[$j])->ten;            
            }
            $job_listings[$i]->kinang = $skills;
        }
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
                'address' => 'required',                
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'name.required' => 'Bạn không được để trống tên!',   
                'address.required' => 'Bạn không được để trống địa chỉ!',
            ]
        );

        // var_dump($rq->all());
        $profile = NhaTuyenDung::find(Auth::user()->id);
        
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
        $profile->diachi = $rq->address;
        $profile->tinhthanhpho = $rq->region;
        $profile->quymodansu = $rq->scale;
        $profile->remember_token = $rq->_token;        

        $profile->update();

        // CHuyển hướng
        return redirect()->back()->with(['success' => "Cập nhật thành công!"]);
    }

    public function viewProfile($profile_id){
        $profile = NguoiTimViec::find($profile_id);
        return view('nhatuyendung.profile-single',compact('profile'));
    }

    public function getSaveProfiles(){
        $follows = json_decode(Auth::user()->theodoi);
        // Chưa bỏ "" trong json nên find k nhận => bỏ array vào lại dc :D
        $profile_list = NguoiTimViec::find($follows);       
        // dd($profile_list);
        return view('nhatuyendung.save-profile-listings',compact('profile_list'));
    }

    public function getAppliedProfiles(){
        $profile_list = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                        ->join('hosoxinviec','hosoxinviec.idTTD','=','tintuyendung.id')
                        ->select('hosoxinviec.*','tintuyendung.nganh as title') 
                        // ĐK để lọc hồ sơ thuộc nhà tuyển dụng nào quản lý
                        ->where('nhatuyendung.idUser','=',Auth::user()->id)
                        ->paginate(3)->fragment('next-section');
        // dd($profile_list);    
        return view('nhatuyendung.applied-profile-listings',compact('profile_list'));
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
        // var_dump($rq->all());

        $key = $rq->key;
        $khuvuc = $rq->region;
        $trangthai = $rq->status;

        $profile_list = NguoiTimViec::where('congkhai',1)
                    ->where('trangthai',1)
                    ->where(function($query) use($key,$khuvuc,$trangthai){
                        if(!empty($key)) $query->orWhere('nganh','LIKE',"%$key%");
                        if(!empty($khuvuc)) $query->orWhere('khuvuc','LIKE',$khuvuc);
                        if(!empty($trangthai)) $query->orWhere('trangthailv','LIKE',$trangthai);
                    })->paginate(2)->appends([
                                    'key' => $key,
                                    'region' => $khuvuc,
                                    'status' => $trangthai,
                                ]);
        // dd($profile_list);
        return view('nhatuyendung.home',compact('profile_list'));
    }

    public function viewApplied($user_id,$job_id){
        $profile = HoSoXinViec::where('idUser',$user_id)
                    ->where('idTTD',$job_id)->get()->first();
        // dd($profile);
        return view('nhatuyendung.applied-single',compact('profile'));
    }
}