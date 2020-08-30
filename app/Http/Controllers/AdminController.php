<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuyenDung;
use App\NguoiTimViec;
use App\NhaTuyenDung;
use App\HoSoXinViec;
use App\LienHe;
use App\User;
use App\Blog;
use App\Comment;
use App\YKien;
use Mail;
use App\Mail\NewJob;
use App\Mail\Applied;
use DB;
// include base_path()."/app/Function/functions.php";
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
    	$job_list = TinTuyenDung::all();
        // dd($job_list);
    	return view('admins.tintuyendung.list',compact('job_list'));
    }

    public function getApprovedRecList(){
    	$job_list = TinTuyenDung::where('ad_pheduyet',0)->get();
    	return view('admins.tintuyendung.approved',compact('job_list'));
    }

    public function approvedRec($ttd_id){   
        // Thông báo cho nh~ NTV đang theo dõi NTD sở hữu TTD này
        $post = TinTuyenDung::where('id',$ttd_id)->get()->first();
        // dd($post);
        $ntd = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
            ->select('nhatuyendung.ten',DB::raw('COUNT(*) as count'))
            ->where('tintuyendung.ad_pheduyet',1)
            ->where('tintuyendung.idNTD',$post->idNTD)
            ->groupBy('nhatuyendung.ten')
            ->get()->first()->toArray();        
        // dd($ntd);        
        $f_user_list = User::where('theodoi_ntd','LIKE',"%\"$post->idNTD\"%")
                    ->select('email')
                    ->get()->first();
        // dd($f_user_list);        
        // Example
        // $f_user_list = ['email' => 'conbaba999990@gmail.com' , 'email' => 'hongphat701@gmail.com'];
        // $f_user_list = array_values($f_user_list);   
        if($f_user_list){
            $f_user_list = $f_user_list->toArray(); 
            $ntd['count'] = $ntd['count'] + 1;
            
            Mail::send(new NewJob($f_user_list,$ntd));  
        } 
        $post->ad_pheduyet = 1;
        $post->update();
    	return redirect()->back()->with(['success' => 'hoàn tất phê duyệt tin tuyển dụng '.$ttd_id.'!']);
    }

    public function clear(){
        $date = date('Y-m-d');
        $jobs = TinTuyenDung::whereDate('hantuyendung','<', $date)
                    ->delete();
        // dd($jobs);
        return redirect()->back()->with(['success' => "Đã xoá $jobs tin tuyển dụng đã hết hạn!"]);
        // Xoá tin tuyển dụng thì pải đối mật vs vấn đề:
        // Tin tuyển dụng có hồ sơ xin việc => Tạm thời xoá sách lun hồ sơ :D        
    }

    // Hồ sơ
    public function getProfileList(){
    	$profile_list = NguoiTimViec::all();
    	return view('admins.hoso.list',compact('profile_list'));
    }

    public function getApprovedPrfList(){
    	$profile_list = NguoiTimViec::where('ad_pheduyet',0)->get();
    	return view('admins.hoso.approved',compact('profile_list'));
    }
    // Hàm này chỉ xét mẫu hồ sơ
    public function approvedPrf($hs_id){
    	// $profile = NguoiTimViec::where('id',$hs_id)
    	// 			->update(['ad_pheduyet' => 1]);

        $ntv = NguoiTimViec::where('id',$hs_id)
                    ->get()->first();
        // Thông báo đến người tìm việc là mẫu dc duyệt hay từ chối?
        NguoiTimViec::where('id',$hs_id)->update(['ad_pheduyet' => 1]);

    	return redirect()->back()->with(['success' => 'hoàn tất phê duyệt hồ sơ '.$hs_id.', đã gửi thông báo đến người tìm việc!']);
    }

    public function getAppliedPrfList(){
        // $profile_list = HoSoXinViec::where('ad_pheduyet',0)->get();
        $profile_list = HoSoXinViec::where('ad_pheduyet',0)->get();
        // dd($profile_list);
        return view('admins.hoso.applied_list',compact('profile_list'));
    }

    public function approvedAppliedPrf($ttd_id,$usr_id){

        $ntd = NhaTuyenDung::where('idUser',TinTuyenDung::find($ttd_id)->idNTD)
                    ->get()->first();
        // Thông báo đến nhà tuyển dụng       
        $to_email = User::find($ntd->idUser)->email; 
        // dd($to_email);
        if($to_email) Mail::send(new Applied($to_email));

        $hs = HoSoXinViec::where('idTTD',$ttd_id)->where('idUser',$usr_id)->get()->first();
        $hs->ad_pheduyet = 1;
        $hs->update();
        // dd($hs);
        
        return redirect()->back()->with(['success' => 'hoàn tất phê duyệt hồ sơ ID "'.$hs->id.'", đã gửi thông báo đến nhà tuyển dụng!']);
    }

    // Liên hệ
    public function getContactList(){
        $contact_list = LienHe::where('trangthai',0)->get();
        return view('admins.lienhe.list',compact('contact_list'));
    }

    // Tài khoản
    public function getJobSeekerList(){
    	$user_list = User::where('loaitk',0)->paginate(15);
    	return view('admins.nguoidung.job-seeker-list',compact('user_list'));
    }

    public function getBusinessList(){
    	$user_list = User::where('loaitk',1)->paginate(15);
    	return view('admins.nguoidung.business-list',compact('user_list'));
    }

    public function getAdminList(){
        $user_list = User::where('loaitk',2)->paginate(15);
    	return view('admins.nguoidung.admin-list',compact('user_list'));
    }

    // Blog
    public function getBlogList(){
        $blog_list = Blog::all();
        return view('admins.baiviet.list',compact('blog_list'));   
    }

    public function ApprovedBlog($blog_id){        
        Blog::where('id',$blog_id)->update(['ad_pheduyet' => 1]);
        return redirect()->back()->with(['success' => 'Đã phê duyệt bài viết ID '.$blog_id.' ,Success!']);
    }

    public function getCommentList($blog_id){
        $cmt_list = Comment::where('idBlog',$blog_id)->paginate(20);
        return view('admins.baiviet.comment-list',compact('cmt_list'));
    }

    public function deleteCmt($cmt_id){
        Comment::where('id',$cmt_id)->delete();
        return redirect()->back()->with(['success' => 'Đã xoá bình luận ID '.$cmt_id.' ,Success!']);
    }

    // Thu thập ý Kiến
    public function getOpinionList(){
        $opinion_list = YKien::all();
        // dd($opinion_list);
        return view('admins.ykien.list',compact('opinion_list'));
    }

    public function insertOpinion($opinion_id){
        $opinion = YKien::find($opinion_id);
        // Thêm
        if($opinion->loai == 'ngành'){
            if(file_exists( public_path()."/resources/jobs.json")){
                $job_list = json_decode(file_get_contents(url("resources/jobs.json")));
                // Chuẩn hoá về thường rồi mới so sánh
                $job_list_comparison = array_map('mb_strtolower', $job_list);
                $ten = trim(mb_strtolower($opinion->ten));
                // dd($job_list);
                // Kiểm xem trong ds có chưa?
                if(!in_array($ten, $job_list_comparison)){
                    array_push($job_list,$opinion->ten);
                    $path = public_path().'\resources\jobs.json';
                    file_put_contents($path,json_encode($job_list,JSON_UNESCAPED_UNICODE));
                }
                
            }
        }
        // dd($opinion);
        YKien::destroy($opinion_id);
        return redirect()->back()->with(['success' => 'Đã thêm ý kiến vào danh sách!']);
    }

    public function deleteOpinion($opinion_id){
        YKien::destroy($opinion_id);
        return redirect()->back()->with(['success' => 'Đã xoá ý kiến vừa chỉ định!']);
    }
}