<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NganhNghe;
use App\BangCap;
use App\CapBac;
use App\KinhNghiem;
use App\NguoiTimViec;
use App\KiNang;
use App\HoSoXinViec;
use App\User;
use Auth;

class NguoiTimViecController extends Controller
{
    //
    public function getApply($ttd_id){
        $hoso = NguoiTimViec::where('idUser','=',Auth::user()->id)->first();
        // var_dump($hoso);        

        $skill_list = KiNang::all();
        $city_list = json_decode(file_get_contents("https://thongtindoanhnghiep.co/api/city"))->LtsItem;
        array_pop($city_list);

        $exp_list = KinhNghiem::all();
        $ds_job = NganhNghe::all();
        $ds_bc = BangCap::all();
        $ds_cb = CapBac::all();

    	return view('nguoitimviec.apply',compact('city_list','exp_list','skill_list','ds_job','ds_bc','ds_cb','hoso','ttd_id'));
    }

    public function postApply(Request $rq,$ttd_id){
        var_dump($rq->all());
        // Problem: chưa giải quyết withInput 
        $this->validate($rq, 
            [
                //Kiểm tra giá trị rỗng
                'email' => 'required|email',
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
        $profile->kinang = $skills;
        $profile->emaillienhe = $rq->email;
        $profile->nganh = $rq->title;
        $profile->khuvuc = $rq->region;
        $profile->kinhnghiem = $rq->exp;
        $profile->honnhan = $rq->marital_stt;       
        $profile->trangthailv = $rq->status;
        $profile->bangcap = $rq->degree;
        $profile->capbac = $rq->rank;
        $profile->remember_token = $rq->_token;

        // 0 là chưa phê duyệt, 1 là đã phê duyệt và gửi đến nhà tuyển dụng
        $profile->trangthai = 1;
                
        // dd($profile);
        $profile->save();

        return redirect()->route('notification')->with(['alert' => 'Nộp đơn thành công!']);
    }

    public function getProfile(){
    	// Kiểm tra xem user này tạo hồ sơ chưa? có thì lấy
    	$hoso = NguoiTimViec::where('idUser','=',Auth::user()->id)->first();
    	// var_dump($hoso);        
        $exp_list = KinhNghiem::all();
        $skill_list = KiNang::all();
    	$city_list = json_decode(file_get_contents("https://thongtindoanhnghiep.co/api/city"))->LtsItem;
    	array_pop($city_list);

    	$ds_job = NganhNghe::all();
    	$ds_bc = BangCap::all();
    	$ds_cb = CapBac::all();
    	return view('nguoitimviec.profile',compact('city_list','exp_list','skill_list','ds_job','ds_bc','ds_cb','hoso'));
    }

    public function postProfile(Request $rq){    	
    	// var_dump($rq->all());
        // Problem: chưa giải quyết withInput 
    	$this->validate($rq, 
			[
				//Kiểm tra giá trị rỗng
				'email' => 'required|email',
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
                'skill.required' => 'Bạn chưa chọn kĩ năng!',
                'exp.required' => 'Bạn chưa chọn số năm kinh nghiệm!',
				'email.email' => 'Email không đúng định dạng!',
				'title.required' => 'Bạn chưa nhập ngành nghề!',
				'degree.required' => 'Bạn chưa chọn bằng cấp!',
				'rank.required' => 'Bạn chưa chọn cấp bậc!',			
				'region.required' => 'Bạn chưa chọn khu vực!',
			]
		);

    	$profile = NguoiTimViec::where('idUser','=',Auth::user()->id)->first();    	
    	// Nếu chưa có hồ sơ thì tạo
    	if(empty($profile)){
    		$profile = new NguoiTimViec;	
    		$profile->idUser = Auth::user()->id;  	    	
    	}
    	  		   
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
    	$profile->kinang = $skills;
    	$profile->emaillienhe = $rq->email;
    	$profile->nganh = $rq->title;
    	$profile->khuvuc = $rq->region;
        $profile->kinhnghiem = $rq->exp;
    	$profile->honnhan = $rq->marital_stt;    	
    	$profile->trangthailv = $rq->status;
    	$profile->bangcap = $rq->degree;
    	$profile->capbac = $rq->rank;
        $profile->remember_token = $rq->_token;

    	// 0 là chưa công khai, 1 là công khai
    	$profile->trangthai = 1;
    	    	
    	// dd($profile);
    	$profile->save();

    	return redirect()->back()->with(['success' => 'Lưu thành công!']);
    }

    public function saveJob($news_id){        
        $user = User::find(Auth::user()->id);

        $follow = json_decode($user->theodoi);

        // Nếu chưa có follow nào cả thì tạo mảng mới
        if(!is_array($follow)) $follow = array();
        // Chèn vào đầu mảng
        // Phòng trường hợp nếu có r thì k thêm nữa
        if(!in_array($news_id,$follow)) array_unshift($follow, $news_id);

        $user->theodoi = json_encode($follow);

        $user->update();
        echo "Đã thêm ttd";
    }

    public function unsaveJob($news_id){
        $user = User::find(Auth::user()->id);

        $follow = json_decode($user->theodoi);

        // Xoá phần tử trong mảng
        array_unshift($follow, $news_id);

        $user->theodoi = json_encode($follow);

        $user->update();
        echo "Đã thêm ttd";
    }
}