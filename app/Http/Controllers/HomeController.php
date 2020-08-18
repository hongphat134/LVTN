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
use App\Blog;
use App\Comment;
use Auth;
use DB;
use Illuminate\Support\Arr;
// Thay thế cho autoload files vì gây lỗi trên HOST
// include base_path()."/app/Function/functions.php";
// Thầy yêu cầu thanh tìm kiếm city pải sắp xếp theo miền Bắc, Trung, Nam :D
class HomeController extends Controller
{
    public function index(){    
    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->select('tintuyendung.*','nhatuyendung.ten','nhatuyendung.hinh')
                ->where('tintuyendung.ad_pheduyet',1)
    			->get();
        // dùng random phải có record lớn hơn n random :D ko thì BUG
        if($job_listings->count() > 10) $job_listings = $job_listings->random(10);
        // dd($job_listings);

        $job_listings->typeRecord = 1;
        $candidates = NguoiTimViec::count();
        $companies = NhaTuyenDung::count();
        $jobs_posted = TinTuyenDung::count();
        // Biến này chưa hiểu :D
        // $jobs_filled = ?;        
    	return view('pages.home',compact('job_listings','candidates','companies','jobs_posted'));        
    }

    public function getNews($news_id){    	
    	$news = TinTuyenDung::where('tintuyendung.id','=',$news_id)
                ->where('ad_pheduyet',1)
    			->get()->first();

        if($news == null) return redirect('/error')->with(['error' => 'Lỗi tìm kiếm tin tuyển dụng!']);                
        $owner = NhaTuyenDung::where('nhatuyendung.idUser',$news->idNTD)->get()->first();
        // dd($owner);
		$cond_skill = json_decode($news->kinang);                    
        // dd($news);   
        // Nếu nộp hồ sơ r thì ko dc ứng tuyển và hiển thị ngày nộp
        if(Auth::check())
        $hoso = HoSoXinViec::where('idTTD','=',$news_id)
            ->where('idUser','=',Auth::user()->id)
            ->select('idTTD','created_at')->get()->first();	
        else $hoso = null;        
        // Get Tin liên quan theo tiêu chí: ngành nghề => Done
        // Tiêu chí kĩ năng hơi khó => Done
        // Tiêu chí khu vực => Done
        $cond_city = json_decode($news->tinhthanhpho);
        $news_nganh = $news->nganh;
        $news->luotxem = $news->luotxem + 1;
        $news->update();
      
        $related_jobs = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')                
                ->where('tintuyendung.id','<>',$news->id)
                ->where('tintuyendung.ad_pheduyet',1)
                ->where(function($query) use($cond_city,$cond_skill,$news_nganh){
                    $query->orWhere('tintuyendung.nganh','LIKE',$news_nganh);
                    foreach ($cond_city as $city) {
                        $query->orWhere('tintuyendung.tinhthanhpho','LIKE',"%\"$city\"%");
                    }   
                    foreach ($cond_skill as $skill) {
                        $query->orWhere('tintuyendung.kinang','LIKE',"%\"$skill\"%");
                    }                   
                })
                ->take(5)->get();
        // dd($related_jobs);
    	return view('pages.job-single',compact('news','hoso','related_jobs','owner'));
    }

    public function getJobs(){
    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->where('tintuyendung.ad_pheduyet',1)
    			->paginate(4)->fragment('next');
        $job_listings->typeRecord = 1;

    	return view('pages.job-listings',compact('job_listings'));
    }
    
    public function search(Request $rq){    	
    	$key = $rq->key;
        // Single region
    	// $region = $rq->region;
    	$status = $rq->status;
        // Multi region
        $regions = $rq->region;
        // dd($region);
        $sort = $rq->sort;

    	$job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')->where('tintuyendung.ad_pheduyet',1);
    	if(!empty($key)){
            $job_listings->where(
                function($query) use ($key){
                    $query->orWhere('tintuyendung.nganh','LIKE','%'.$key.'%');
                    $query->orWhere('tintuyendung.kinang','LIKE',"%\"$key\"%");
                }
            );                                       
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
        if(!empty($sort)){
            // Tin mới cập nhật
            if($sort == 1){
                $job_listings->orderBy('tintuyendung.updated_at','desc');
            }
            // Tin có hạn tuyển dụng dài
            else if($sort == 2){
                $job_listings->orderBy('tintuyendung.hantuyendung','desc');
            }
        }       
    		
    	$job_listings = $job_listings->paginate(15)->fragment('next')->appends(
    										[
    											'key' => $key, 
    											'region' => $regions,
    											'status' => $status,
                                                'sort' => $sort,
    										]);
        // dd($job_listings);
        $job_listings->typeRecord = 1;
        return view('pages.job-listings',compact('job_listings','key','regions','status','sort'));
    }

    public function searchBySkill($skill){           
        $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->where('tintuyendung.ad_pheduyet',1)
                ->where('tintuyendung.kinang','LIKE',"%\"$skill\"%")
                ->paginate(15)->fragment('next');
         
        $job_listings->typeRecord = 1;
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
        // Chuyển thẳng vào trang chủ NTD
        return redirect()->route('notification')->with(['alert' => 'Đăng ký nhà tuyển dụng thành công!']);      
    }
    
    public function getSkillsJobs($key){
        $list = [];
        if(file_exists( public_path()."/resources/skills.json") &&
            file_exists( public_path()."/resources/jobs.json")){
            $skill_list = json_decode(file_get_contents(url("resources/skills.json")));
            $job_list = json_decode(file_get_contents(url("resources/jobs.json")));

            foreach ($skill_list as $skill) {
                if(stripos($skill,$key) !== false) $list[] = $skill;
            }
            foreach ($job_list as $job) {
                if(stripos($job,$key) !== false) $list[] = $job;
            }            
        }        
        
        echo json_encode($list);    
    }

    public function changeUserName(Request $rq){       
        // set default lỗi validate
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
        // Nếu validate success thì xoá user-warning
        session()->forget('user-warning');
        $user = Auth::user();

        $user->ten = $rq->name;
        $user->remember_token = $rq->_token;

        $user->update();

        return redirect()->back()->with(['user-success' => "Đổi tên thành công!"]);
    }

    public function changeUserPassword(Request $rq){
        // Problem: chưa xử lý TH Facebook login = sdt và ko có email
        // echo "Change Password";
        // var_dump($rq->all());
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
        // TH Facebook không có Email và đăng nhập = sdt => Chưa hoàn chỉnh
        if(!empty($rq->email)){
            $user = Auth::user();

            $user->email = $rq->email;
            $user->password = bcrypt($rq->password);
            $user->remember_token = $rq->_token;            

            $user->update();

            return redirect()->back()->with(['user-success' => "Thiết lập mật khẩu cho tài khoản liên kết thành công! Bạn có thể đăng nhập như tài khoản của hệ thống!"]);
        }

        // TH là tài khoản Google or Facebook có email chưa set password
        if(empty($rq->old_password)){
            $user = Auth::user();

            $user->password = bcrypt($rq->password);
            $user->remember_token = $rq->_token;            

            $user->update();

            return redirect()->back()->with(['user-success' => "Thiết lập mật khẩu cho tài khoản liên kết thành công! Bạn có thể đăng nhập như tài khoản của hệ thống!"]);
        }
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

    public function getCreateBlog(){
        return view('pages.create-blog');
    }

    public function postCreateBlog(Request $rq){
        // dd($rq->all());
        $this->validate($rq,
            [
                'title' => 'required|string|min:6|max:50',                
                'content' => 'required|string|min:30|max:1200',
            ],
            [
                'title.required' => 'Không để trống tiêu đề bạn nhé!',
                'title.min' => 'Tiêu đề phải có tối thiểu 6 kí tự!',     
                'title.max' => 'Tiêu đề chỉ có tối đa 50 kí tự!',                
                'content.required' => 'Không để trong nội dung bạn nhé!',
                'content.min' => 'Nội dung phải có tối thiểu 30 kí tự!',
                'content.max' => 'Tiêu đề chỉ có tối đa 1200 kí tự!',                
            ]
        );

        $blog = new Blog;

        $blog->tieude = $rq->title;
        $blog->phude = $rq->sub_title;
        $blog->noidung = $rq->content;
        // Xử lý hình
        if($rq->hasFile('picture')){
            $this->validate($rq, 
                [                   
                    'picture' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [                   
                    'picture.mimes' => 'Chỉ chấp nhận hình với đuôi .jpg .jpeg .png .gif',
                    'picture.max' => 'Hình giới hạn dung lượng không quá 2M',
                ]
            );
            //Lưu hình ảnh vào thư mục public/upload/hinhthe
            $rq_hinh = $rq->file('picture');
            $hinh = time().'_'.$rq_hinh->getClientOriginalName();
            $destinationPath = public_path('blog_images');
            $rq_hinh->move($destinationPath, $hinh);                    
            $blog->hinh = $hinh;
        }
        
        $blog->idUser = Auth::user()->id;
        $blog->remember_token = $rq->_token;

        $blog->save();
        // Chuyển về?
        return redirect('/thongbao')->with(['alert' => 'Tạo Blog thành công!']);
    }

    public function getUpdateBlog($blog_id){
        $blog = Blog::find($blog_id);
        // dd($blog);
        return view('pages.update-blog',compact('blog'));
    }

    public function postUpdateBlog($blog_id,Request $rq){
        $this->validate($rq,
            [
                'title' => 'required|string|min:6|max:50',                
                'content' => 'required|string|min:30|max:1200',
            ],
            [
                'title.required' => 'Không để trống tiêu đề bạn nhé!',
                'title.min' => 'Tiêu đề phải có tối thiểu 6 kí tự!',     
                'title.max' => 'Tiêu đề chỉ có tối đa 50 kí tự!',                
                'content.required' => 'Không để trong nội dung bạn nhé!',
                'content.min' => 'Nội dung phải có tối thiểu 30 kí tự!',
                'content.max' => 'Tiêu đề chỉ có tối đa 1200 kí tự!',                
            ]
        );

        $blog = Blog::find($blog_id);

        $blog->tieude = $rq->title;
        $blog->phude = $rq->sub_title;
        $blog->noidung = $rq->content;
        // Xử lý hình
        if($rq->hasFile('picture')){
            $this->validate($rq, 
                [                
                    'picture' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [                    
                    'picture.mimes' => 'Chỉ chấp nhận hình với đuôi .jpg .jpeg .png .gif',
                    'picture.max' => 'Hình giới hạn dung lượng không quá 2M',
                ]
            );
            //Lưu hình ảnh vào thư mục public/upload/hinhthe
            $rq_hinh = $rq->file('picture');
            $hinh = time().'_'.$rq_hinh->getClientOriginalName();
            $destinationPath = public_path('blog_images');
            $rq_hinh->move($destinationPath, $hinh);
            // Xử lý hình cũ khi cập nhật hình
            $rm_name_img = $blog->hinh;
            if(!empty($rm_name_img)) unlink(public_path('blog_images/'.$rm_name_img));
            $blog->hinh = $hinh;
        }
        
        $blog->idUser = Auth::user()->id;
        $blog->remember_token = $rq->_token;

        $blog->update();

        return redirect()->back()->with(['success' => 'Cập nhật Blog thành công!']);
    }

    public function getBlogList(){
        $blog_list = Blog::where('idUser',Auth::user()->id)->paginate(5);
        $blog_list->typeRecord = 3;
        // dd($blog_list);
        return view('pages.blog-listings',compact('blog_list'));
    }

    public function showForum(){
        $blog_list = Blog::leftJoin('comment','blog.id','=','comment.idBlog')
                ->select('blog.id','blog.tieude','blog.hinh','blog.updated_at',DB::raw('COUNT(comment.id) as count'))
                ->where('blog.ad_pheduyet',1)
                ->groupBy('blog.id','blog.tieude','blog.hinh','blog.updated_at')
                ->paginate(6)->fragment('content');
        $blog_list->typeRecord = 3;
        // dd($blog_list);
        return view('pages.blog',compact('blog_list'));
    }

    public function showSingleBlog($blog_id){
        $blog = Blog::find($blog_id);
        $author = User::find($blog->idUser);
        $blog_list = Blog::leftJoin('comment','blog.id','=','comment.idBlog')
                ->select('blog.id','blog.tieude','blog.hinh','blog.updated_at',DB::raw('COUNT(comment.id) as count'))
                ->groupBy('blog.id','blog.tieude','blog.hinh','blog.updated_at')
                ->take(8)->get();
        // dd($author);
        // $cmt_list = Comment::where('idBlog',$blog_id)->get();
        $cmt_list = User::join('comment','users.id','=','comment.idUser')
                ->where('comment.idBlog',$blog_id)
                ->get();
        return view('pages.blog-single',compact('blog','author','cmt_list','blog_list'));
    }

    public function postComment(Request $rq){
        $comment = new Comment;

        $comment->idUser = Auth::user()->id;
        $comment->idBlog = (int)$rq->idBlog;
        $comment->noidung = $rq->content;

        $comment->save();
        $arr = $rq->all();
        $arr['name'] = Auth::user()->ten;
        $arr['created_at'] = date('d/m/Y \v\à\o \l\ú\c H:i');
        echo json_encode($arr);
    }

    public function searchByJobs(){
        if(file_exists( public_path()."/resources/jobs.json")){
            $job_list = json_decode(file_get_contents(url("resources/jobs.json")));
            return view('pages.others.jobs-list',compact('job_list'));
        }
        return redirect()->back();
    }

    public function searchBySkills(){
        if(file_exists( public_path()."/resources/skills.json")){
            $skill_list = json_decode(file_get_contents(url("resources/skills.json")));
            return view('pages.others.skills-list',compact('skill_list'));
        }
        return redirect()->back();
    }

    public function searchByCities(){
        if(file_exists( public_path()."/resources/cities.json")){
            $region_list = json_decode(file_get_contents(url("resources/cities.json")));            
            return view('pages.others.cities-list',compact('region_list'));
        }
        return redirect()->back();
    }

    public function showRecDetails($rec_id){
        $ntd = NhaTuyenDung::find($rec_id);
        $job_listings = TinTuyenDung::where('idNTD',$rec_id)->paginate(6)->fragment('next');
        $job_listings->typeRecord = 1;
        // dd($ntd);
        return view('pages.rec-details',compact('ntd','job_listings'));
    }

    public function getAdvancedSearch(){        
        return view('pages.advance-search');
    }

    public function postAdvancedSearch(Request $rq){
        // dd($rq->all());
        $job_listings = null;
        // Khởi động Eloquent
        if($rq->has('_token')){
            $job_listings = NhaTuyenDung::join('tintuyendung','nhatuyendung.idUser','=','tintuyendung.idNTD')
                ->select('tintuyendung.*','nhatuyendung.hinh','nhatuyendung.ten');
        }
        if($rq->has('job')){
            if($rq->condition == 'and') $job_listings->whereIn('tintuyendung.nganh',$rq->job);  
            else $job_listings->orWhereIn('tintuyendung.nganh',$rq->job);
        } 
        if($rq->has('skill')){            
            if($rq->condition == 'and'){
                $cond_skills = $rq->skill;
                $job_listings->where(function($query) use ($cond_skills){
                    foreach ($cond_skills as $skill) {
                        $query->orWhere('tintuyendung.kinang','LIKE','%"'.$skill.'"%');
                    }            
                });
            }
            else
                foreach ($rq->skill as $skill) {
                    $job_listings->orWhere('tintuyendung.kinang','LIKE','%"'.$skill.'"%');
                }
        }
        if($rq->has('region')){
            if($rq->condition == 'and'){
                $cond_cities = $rq->region;
                $job_listings->where(function($query) use ($cond_cities){
                    foreach ($cond_cities as $city) {
                        $query->orWhere('tintuyendung.tinhthanhpho','LIKE','%"'.$city.'"%');
                    }            
                });
            }
            else
                foreach ($rq->region as $city) {
                    $job_listings->orWhere('tintuyendung.tinhthanhpho','LIKE','%"'.$city.'"%');
                }            
        }
        if($rq->has('degree')){
            if($rq->condition == 'and') $job_listings->whereIn('tintuyendung.bangcap',$rq->degree);  
            else $job_listings->orWhereIn('tintuyendung.bangcap',$rq->degree);

        }
        if($rq->has('salary')){
            if($rq->condition == 'and') $job_listings->whereIn('tintuyendung.mucluong',$rq->salary);  
            else $job_listings->orWhereIn('tintuyendung.mucluong',$rq->salary);
        }
        if($rq->number){
            $job_listings->where('tintuyendung.soluong','<=',$rq->number);  
        }

        if($job_listings){
            $job_listings = $job_listings->where('ad_pheduyet',1)->paginate(5)->fragment('content');
            $job_listings->typeRecord = 1;  
        } 

        $search_info = $rq->all();
        // dd($job_listings);
        return view('pages.advance-search',compact('job_listings','search_info'));        
    }
}