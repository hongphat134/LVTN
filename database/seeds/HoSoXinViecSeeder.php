<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HoSoXinViecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('hosoxinviec')->truncate();


        $name_list = array('Phát','Thiện','Tân','Thành','Tiến','Luân','Lương','Lộc','Tuấn','Hoà','Hưng','An','Anh','Khương');
        $sotruong_list = array('Kiên trì','Ca hát','Hài hước','Vui tính','Hoà đồng','Cá tính','Chăm chỉ','Thận trọng','Tạo không khí, cảm xúc cho mọi người xung quanh');
        $muctieu_list = array('Có 1 công việc ổn định','Trở thành nhân viên xuất sắc','Tích luỹ thêm kinh nghiệm','rèn luyện kĩ năng xử lý công việc','Nỗ lực, cố gắng và mong muốn có được vị trí cấp cao','Nhanh chóng thích nghi và làm tốt tất cả các yêu cầu được công ty đề cập trong bản mô tả công việc','Tôi muốn cung cấp nhiều giá trị, đóng góp hơn những gì tôi mong đợi','Nâng cao trình độ, đóng góp nhiều hơn vào sự phát triển của công ty, sau đó đủ khả năng nhận các trách nhiệm lớn hơn','Tôi hiểu rằng quá trình này có thể khó khăn và tốn thời gian, nhưng tôi luôn sẵn sàng và kiên định','Những mục tiêu này sẽ luôn thúc đẩy tôi đạt được tầm cao mới, giữ vững định hướng của mình'); 
        $kinang_list = json_decode(file_get_contents(public_path().'\resources\skills.json'));        
        $nganh_list = json_decode(file_get_contents(public_path().'/resources/jobs.json'));
        $region_list = json_decode(file_get_contents(public_path().'/resources/cities.json'));
        $kinhnghiem_list = json_decode(file_get_contents(public_path().'/resources/exps.json'));
        $mucluong_list = json_decode(file_get_contents(public_path().'/resources/salaries.json'));
        $bangcap_list = json_decode(file_get_contents(public_path().'/resources/degrees.json'));
        $capbac_list = json_decode(file_get_contents(public_path().'/resources/ranks.json'));
        $ngoaingu_list = json_decode(file_get_contents(public_path().'/resources/languages.json'));
        $tinhoc_list = json_decode(file_get_contents(public_path().'/resources/itechs.json'));

        $count = 2000;

        for ($i=0; $i < $count; $i++) {
         	$name = Arr::random($name_list).' '.Arr::random($name_list); 
            $email = str_slug($name).'_'.Str::random(5).'@gmail.com';
            $kinang = Arr::random($kinang_list,mt_rand(1,5));
            $nganh = Arr::random($nganh_list); 
            // $nganh = Arr::random($nganh_list,mt_rand(1,3)); 
            $tp = Arr::random($region_list->MienNam)->Ten;
            $kinhnghiem = Arr::random($kinhnghiem_list);
            $mucluong = Arr::random($mucluong_list);
            $bangcap = Arr::random($bangcap_list);        
            $capbac = Arr::random($capbac_list); 
            $ngoaingu = Arr::random($ngoaingu_list,mt_rand(1,5));
            $tinhoc = Arr::random($tinhoc_list,mt_rand(1,4));  
            $muctieu_arr = Arr::random($muctieu_list,mt_rand(2,5));
            $muctieu = "";
            for ($k=0; $k < count($muctieu_arr) ; $k++) { 
            	$muctieu .= $muctieu_arr[$k]."\n";
            }
            $sotruong_arr = Arr::random($sotruong_list,mt_rand(2,5));
            $sotruong = "";
             for ($k=0; $k < count($sotruong_arr) ; $k++) { 
            	$sotruong .= $sotruong_arr[$k]."\n";
            }

        	DB::table('hosoxinviec')->insert(
        		[
        			"idUser" => mt_rand(7,500),
					"idTTD" => mt_rand(1,100),
					"hoten" => $name,
					"emaillienhe" => $email,
                    "sdtlienhe" => '0938922315',
					// "nganh" => json_encode($nganh,JSON_UNESCAPED_UNICODE),
                    "nganh" => $nganh,
					"kinang" => json_encode($kinang,JSON_UNESCAPED_UNICODE),
					"khuvuc" => $tp,
					"honnhan" => Arr::random(['Độc thân','Đã kết hôn']),
					"hinhthuc_lv" => Arr::random(['Part Time','Full Time']),
                    "gioitinh" => 'Nữ',
                    'ngaysinh' => '1998-05-05',
					"bangcap" => $bangcap,
					"capbac" => $capbac,
					"kinhnghiem" => $kinhnghiem,
					"mucluongmm" => $mucluong,
					"muctieu" => $muctieu,
					"ngoaingu" => json_encode($ngoaingu,JSON_UNESCAPED_UNICODE),
					"tinhoc" => json_encode($tinhoc,JSON_UNESCAPED_UNICODE),
					"sotruong" => $sotruong,
					"new" => 1,
					"ntd_ungtuyen" => mt_rand(0,1),
					"ad_pheduyet" => mt_rand(0,1),
					"remember_token" => '',
					'created_at' => Carbon\Carbon::now()->toDateTimeString(),                   
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),                   
        		]
        	);
        }

        Schema::enableForeignKeyConstraints();
    }
}
