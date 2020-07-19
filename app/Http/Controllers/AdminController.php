<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuyenDung;
use App\NguoiTimViec;
use App\LienHe;
use App\User;

class AdminController extends Controller
{
    //
    public function getLogin(){
        return view('admins.login');
    }
    
    public function home(){
    	return view('admins.home');
    }

    // Tin Tuyển dụng
    public function getRecList(){
    	$job_list = TinTuyenDung::paginate(3);
    	return view('admins.tintuyendung.list',compact('job_list'));
    }

    public function getApprovedRecList(){
    	$job_list = TinTuyenDung::where('congkhai',0)->paginate(3);
    	return view('admins.tintuyendung.approved',compact('job_list'));
    }

    public function approvedRec($ttd_id){
    	$post = TinTuyenDung::where('id',$ttd_id)
    				->update(['congkhai' => 1]);

    	return redirect()->back()->with(['success' => 'hoàn tất phê duyệt tin tuyển dụng '.$ttd_id.'!']);
    }

    public function clear(){
        $date = date('Y-m-d');
        // $date = '2020-07-31';
        $jobs = TinTuyenDung::whereDate('hantuyendung','<', $date)
                    ->delete();
        // dd($jobs);
        return redirect()->back()->with(['success' => "Đã xoá $jobs tin tuyển dụng đã hết hạn!"]);
        // Xoá tin tuyển dụng thì pải đối mật vs vấn đề:
        // Tin tuyển dụng có hồ sơ xin việc
        
    }

    // Hồ sơ
    public function getProfileList(){
    	$profile_list = NguoiTimViec::all();
    	return view('admins.hoso.list',compact('profile_list'));
    }

    public function getApprovedPrfList(){
    	$profile_list = NguoiTimViec::where('trangthai',0)->get();
    	return view('admins.hoso.approved',compact('profile_list'));
    }

    public function approvedPrf($hs_id){
    	$profile = NguoiTimViec::where('id',$hs_id)
    				->update(['trangthai' => 1]);

    	return redirect()->back()->with(['success' => 'hoàn tất phê duyệt hồ sơ '.$hs_id.'!']);
    }

    // Liên hệ
    public function getContactList(){
        $contact_list = LienHe::where('trangthai',0)->get();
        return view('admins.lienhe.list',compact('contact_list'));
    }

    // Tài khoản
    public function getJobSeekerList(){
    	$user_list = User::where('loaitk',0)->get();
    	return view('admins.nguoidung.job-seeker-list',compact('user_list'));
    }

    public function getBusinessList(){
    	$user_list = User::where('loaitk',1)->get();
    	return view('admins.nguoidung.business-list',compact('user_list'));
    }

    public function getAdminList(){
    	return view('admins.quantrivien.list');
    }
}
