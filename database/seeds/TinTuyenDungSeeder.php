<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TinTuyenDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tintuyendung')->truncate();
  
        // Auto tạo seed
        define('COUNT', 100);
        $kinang_list = json_decode(file_get_contents(public_path().'\resources\skills.json'));        
        $nganh_list = json_decode(file_get_contents(public_path().'/resources/jobs.json'));
        $khuvuc_list = json_decode(file_get_contents(public_path().'/resources/cities.json'));
        $kinhnghiem_list = json_decode(file_get_contents(public_path().'/resources/exps.json'));
        $mucluong_list = json_decode(file_get_contents(public_path().'/resources/salaries.json'));
        $bangcap_list = json_decode(file_get_contents(public_path().'/resources/degrees.json'));
        $capbac_list = json_decode(file_get_contents(public_path().'/resources/ranks.json'));
         $ngoaingu_list = json_decode(file_get_contents(public_path().'/resources/languages.json'));
        $tinhoc_list = json_decode(file_get_contents(public_path().'/resources/itechs.json'));

        $quyenloi_list = array(
            'Mức lương khởi điểm 12-15tr trao đổi khi phỏng vấn',
            'Được hưởng các chế độ BHXH theo quy định của nhà nước',
            'Đi du lịch, nghĩ lễ tết theo quy đinh nhà nước',
            'Môi trường làm việc thân thiện, chuyên nghiệp','Các chế độ theo Luật lao động hiện hành và các phúc lợi theo quy định của Công ty',
            'Được tham gia các sự kiện trong những ngày lễ do công ty tổ chức',
            'Thưởng lương tháng 13 và lễ',
            'Lương, thưởng và các chế độ đãi ngộ theo chính sách hiện hành của Công ty',
            'Xét duyệt tăng lương hàng năm',
            'Được chú trọng đào tạo để phát triển toàn diện chứ không chỉ riêng việc viết code');

        $motacv_list = array('Lắp đặt, cài đặt Robot',
            'Hướng dẫn KH sử dụng','Công việc trao đổi khi phỏng vấn',
            'Tham gia vào toàn bộ vòng đời của ứng dụng, tập trung và coding và debug các dự án website và hệ thống',
            'Xây dựng code có thể sử dụng lại và các thư viện để thuận tiện cho việc sử dụng trong tương lai',
            'Thu thập và xử lí các yêu cầu thiết kế và kĩ thuật',
            'Tham gia vào quá trình phân tích và thiết kế hệ thống',
            'Nghiên cứu và áp dụng các công nghệ mới để tối ưu hóa hiệu quả phát triển sản phẩm',
            'Tham gia phát triển hệ thống của công ty và theo yêu cầu của khách hàng');
        
        
        for ($i = 0 ; $i < COUNT ; $i++) {
            // Random
            $kinang = Arr::random($kinang_list,mt_rand(1,5));
            $nganh = Arr::random($nganh_list);
            $tp = Arr::pluck(Arr::random($khuvuc_list->MienNam,mt_rand(1,3)),['Ten']); 
            $kinhnghiem = Arr::random($kinhnghiem_list);
            $mucluong = Arr::random($mucluong_list);
            $bangcap = Arr::random($bangcap_list);        
            $capbac = Arr::random($capbac_list);        
            $hantuyendung = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.mt_rand(1,60).' days'));
            $ngoaingu = Arr::random($ngoaingu_list,mt_rand(1,5));
            $tinhoc = Arr::random($tinhoc_list,mt_rand(1,4)); 
            $motacv = Arr::random($motacv_list,mt_rand(3,6));
            $quyenloi = Arr::random($quyenloi_list,mt_rand(3,6));
            DB::table('tintuyendung')->insert(
                [
                    'kinang' => json_encode($kinang,JSON_UNESCAPED_UNICODE),
                    'nganh' => $nganh,
                    'tinhthanhpho' => json_encode($tp,JSON_UNESCAPED_UNICODE),
                    'soluong' => mt_rand(1,25),
                    'gioitinh' => Arr::random(['Nam','Nữ','Bất kì']),
                    'kinhnghiem' => $kinhnghiem,
                    'mucluong' => $mucluong,
                    'bangcap' => $bangcap,
                    'capbac' =>  $capbac,
                    'hantuyendung' => $hantuyendung,
                    'trangthailv' => Arr::random(['Full Time','Part Time']),                    
                    'ad_pheduyet' => mt_rand(0,1),
                    'motacv' => json_encode($motacv,JSON_UNESCAPED_UNICODE),
                    'quyenloi' => json_encode($quyenloi,JSON_UNESCAPED_UNICODE), 
                    "luotxem" => mt_rand(0,10000),
                    // 'new' => mt_rand(0,1),                  
                    'idNTD' => mt_rand(1,5),
                    'created_at' => Carbon\Carbon::now()->subDays(mt_rand(30,60))->toDateTimeString(),                   
                    'updated_at' => Carbon\Carbon::now()->subDays(mt_rand(1,29))->toDateTimeString()
                ]
            );
        }        

        Schema::enableForeignKeyConstraints();
    }
}
