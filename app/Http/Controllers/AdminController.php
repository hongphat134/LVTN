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
    public function home(){
    	return view('admins.home');
    }

    public function getRecList(){
    	$job_list = TinTuyenDung::all();
    	return view('admins.tintuyendung.list',compact('job_list'));
    }

    public function getApprovedRecList(){
    	$job_list = TinTuyenDung::where('congkhai',0)->get();
    	return view('admins.tintuyendung.approved',compact('job_list'));
    }

    public function approvedRec($ttd_id){
    	$post = TinTuyenDung::where('id',$ttd_id)
    				->update(['congkhai' => 1]);

    	return redirect()->back()->with(['success' => 'hoàn tất phê duyệt tin tuyển dụng '.$ttd_id.'!']);
    }

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

    public function getContactList(){
        $contact_list = LienHe::where('trangthai',0)->get();
        return view('admins.lienhe.list',compact('contact_list'));
    }

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
