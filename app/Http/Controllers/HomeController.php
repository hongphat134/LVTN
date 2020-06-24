<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuyenDung;
use App\NhaTuyenDung;
use App\NguoiTimViec;
use App\HoSoXinViec;
use App\User;
use App\KiNang;
use App\NganhNghe;
use Auth;

class HomeController extends Controller
{
    //
    public function index(){
    	// $data = TinTuyenDung::paginate(3);
    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
    			->paginate(5);

        // Chuyển JSON kĩ năng thành mảng
        for ($i=0; $i < count($job_listings) ; $i++) { 
            $job_listings[$i]->kinang =  json_decode($job_listings[$i]->kinang);
            $skills = array();
            for ($j=0; $j < count($job_listings[$i]->kinang) ; $j++) {                 
                $skills[] = KiNang::find($job_listings[$i]->kinang[$j])->ten;            
            }
            $job_listings[$i]->kinang = $skills;
        }

        $candidates = NguoiTimViec::count();
        $companies = NhaTuyenDung::count();
        $jobs_posted = TinTuyenDung::count();
        // Biến này chưa hiểu :D
        // $jobs_filled = ?;
    	return view('pages.home',compact('job_listings','candidates','companies','jobs_posted'));        
    }

    public function getNews($news_id){    	
    	$news = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
    			->where('tintuyendung.id','=',$news_id)
    			->get()->first();
        
        if($news == null) return redirect('/error')->with(['error' => 'Lỗi tìm kiếm tin tuyển dụng!']);                
		
        $news->kinang = KiNang::whereIn('id',json_decode($news->kinang))
                    ->select('ten')
                    ->get();
                      
        // dd($news);   

        $hoso = HoSoXinViec::where('idTTD','=',$news_id)
            ->select('idTTD','created_at')->get()->first();	

    	return view('pages.job-single',compact('news','hoso'));
    }

    public function getJobs(){
    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
    			->paginate(3);

        // Chuyển JSON kĩ năng thành mảng
        for ($i=0; $i < count($job_listings) ; $i++) { 
            $job_listings[$i]->kinang =  json_decode($job_listings[$i]->kinang);
            $skills = array();
            for ($j=0; $j < count($job_listings[$i]->kinang) ; $j++) {                 
                $skills[] = KiNang::find($job_listings[$i]->kinang[$j])->ten;            
            }
            $job_listings[$i]->kinang = $skills;
        }
                            	
    	return view('pages.job-listings',compact('job_listings'));
    }
    
    public function search(Request $rq){    	
    	// var_dump($rq->all());
    	$key = $rq->key;
    	// $region = $rq->region;
    	$status = $rq->status;

        // Multi region
        $regions = $rq->region;
        // dd($region);

    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD');
    	if(!empty($key)){
            $job_listings = $job_listings->where('tintuyendung.nganh','LIKE','%'.$key.'%')
                                    // kinang dạng json nên k tìm dc
                                    // ->orWhere('tintuyendung.kinang','LIKE','%'.$key.'%')
                                    ->orWhere('nhatuyendung.ten','LIKE','%'.$key.'%');

        } 
    	// if(!empty($region)) $job_listings = $job_listings->where('tintuyendung.tinhthanhpho','LIKE','%'.$region.'%');
    	if(!empty($status)) $job_listings = $job_listings->where('tintuyendung.trangthailv','LIKE',$status);

        if(!empty($regions)){  
            $job_listings->where(
            function($query) use ($regions){                
                foreach ($regions as $region) {
                    $query->orWhere('tintuyendung.tinhthanhpho','LIKE','%'.$region.'%');
                }                                   
            });              
        } 
            
    		
    	$job_listings = $job_listings->paginate(3)->appends(
    										[
    											'key' => $key, 
                                                // 'region' => $region,
    											'region' => $regions,
    											'status' => $status,
    										]);
        // dd($job_listings);

        // Chuyển JSON kĩ năng thành mảng
        for ($i=0; $i < count($job_listings) ; $i++) { 
            $job_listings[$i]->kinang =  json_decode($job_listings[$i]->kinang);
            $skills = array();
            for ($j=0; $j < count($job_listings[$i]->kinang) ; $j++) {                 
                $skills[] = KiNang::find($job_listings[$i]->kinang[$j])->ten;            
            }
            $job_listings[$i]->kinang = $skills;
        }

    	// return view('pages.job-listings',compact('job_listings','key','region','status'));
        return view('pages.job-listings',compact('job_listings','key','regions','status'));
    }

    public function searchBySkill($skill){
        // Get ID Skill
        $skill_id = KiNang::where('ten','LIKE',$skill)->select('id')->first()->id;        
        $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->where('tintuyendung.kinang','LIKE',"%\"$skill_id\"%")
                ->paginate(3);

        // dd($job_listings);
        // Chuyển JSON kĩ năng thành mảng
        for ($i=0; $i < count($job_listings) ; $i++) { 
            $job_listings[$i]->kinang =  json_decode($job_listings[$i]->kinang);
            $skills = array();
            for ($j=0; $j < count($job_listings[$i]->kinang) ; $j++) {                 
                $skills[] = KiNang::find($job_listings[$i]->kinang[$j])->ten;            
            }
            $job_listings[$i]->kinang = $skills;
        }
        return view('pages.job-listings',compact('job_listings'));
    }

    public function getRecRegister(){       

        $scale_list = array(
                    'Dưới 20 người',
                    '20 - 150 người',
                    '150 - 300 người',
                    'Trên 300 người',                    
                );

        return view('pages.rec-register',compact('scale_list'));
    }

    public function postRecRegister(Request $rq){
        $validator = $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng
                'usrname' => 'required|string|max:25',
                'email' => 'required|string|email|max:40|unique:users',
                'password' => 'required|string|min:6|confirmed',               
            ],          
            [
                //Tùy chỉnh hiển thị thông báo
                'password.min' => 'Password phải có tối thiểu 6 kí tự!',
                'password.confirmed' => 'Bạn nhập lại password không đúng!', 
                'usrname.max' => 'Tên tài khoản chỉ có tối đa 25 kí tự!',
                'email.max' => 'Email chỉ có tối đa 40 kí tự!',
                'email.unique' => 'Email đã có người sử dụng!',
            ]
        );
        
        if($validator != null){
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput($rq);
            }    
        }

        var_dump($rq->all());

        // Xử lý hình trước

        $user = new User;
        $user->ten = $rq->usrname;
        $user->email = $rq->email;
        $user->password = bcrypt($rq->password);
        $user->loaitk = 1;
        $user->remember_token = $rq->_token;

        $user->save();

        $ntd = new NhaTuyenDung;

        $ntd->idUser = $user->id;
        $ntd->ten = $rq->name;
        $ntd->diachi = $rq->address;
        $ntd->tinhthanhpho = $rq->region;
        $ntd->quymodansu = $rq->scale;
        // Set up hình mặc định
        $ntd->hinh = 'amazon.jpg';
        // $ntd->vanhoaphucloi = $rq->asdasasdsdds;
        $ntd->remember_token = $rq->_token;

        $ntd->save();

        return redirect()->route('notification')->with(['alert' => 'Đăng ký nhà tuyển dụng thành công!']);      
    }

    public function notification(){
        return view('pages.notification');
    }

    public function getSkillsJobs($key){
        $list1 = KiNang::where('ten','LIKE',"%$key%")->select('ten')->get()->toArray();

        $list2 = NganhNghe::where('ten','LIKE',"%$key%")->select('ten')->get()->toArray();

        $list3 = NhaTuyenDung::where('ten','LIKE',"%$key%")->select('ten')->get()->toArray();

        $list = array_merge($list1,$list2,$list3);

        echo json_encode($list);    
    }

    public function changeUserName(Request $rq){          
        session()->flash('user-warning','Thông tin vừa nhập bị lỗi!');
        $this->validate($rq, 
            [                
                'name' => 'required|max:25',                
            ],          
            [
                'name.required' => 'Bạn chưa nhập tên tài khoản!',
                'name.max' => 'Tên tài khoản chỉ có tối đa 25 kí tự!',
            ]
        );
        session()->forget('user-warning');
        $user = Auth::user();

        $user->ten = $rq->name;
        $user->remember_token = $rq->_token;

        $user->update();
        echo "Change Name";

        return redirect()->back()->with(['user-success' => "Đổi tên thành công!"]);
    }

    public function changeUserPassword(Request $rq){
        // echo "Change Password";
        session()->flash('user-warning','Thông tin vừa nhập bị lỗi!');
        $this->validate($rq, 
            [                
                'password' => 'required|string|min:6|confirmed',
            ],          
            [
                'password.required' => 'Bạn hãy điền mật khẩu!',
                'password.min' => 'Mật khẩu tối thiểu phải có 6 kí tự!',
                'password.confirmed' => 'Mật khẩu nhập lại không chính xác!'
            ]
        );   
        session()->forget('user-warning');
        // Kiểm tra mật khẩu cũ
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $rq->old_password])){
            // echo "Nhập đúng mật khẩu cũ!";            
            $user = Auth::user();

            $user->password = bcrypt($rq->password);
            $user->remember_token = $rq->_token;            

            $user->update();
            // echo "Change Name";

            return redirect()->back()->with(['user-success' => "Đổi mật khẩu thành công!"]);
        }
        else{
            // echo "Sai mật khẩu r";
            return redirect()->back()->with(['user-error' => "Nhập sai mật khẩu cũ!"]);
        }
    }
}