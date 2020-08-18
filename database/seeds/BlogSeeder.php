<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class BlogSeeder extends Seeder
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
        DB::table('blog')->truncate();

        $count = 500;

        $tieude_list = array(
        	'7 cách đánh giá để đưa ra lựa chọn giữa 2 công việc',
        	'Làm sao để viết được lời nhắn sáng tạo đến nhà tuyển dụng',
        	'Cách để hiểu được bạn có chọn nhầm công việc hay không?',
        	'Những vấn đề hay gặp khi đi xin việc',
        	'Cách để nhận ra bản thân phù hợp với công việc nào?',
        	'Tuyển dụng nhân lực cần phải có bí quyết để chính phục ứng viên'
        );

        for ($i=0; $i < $count ; $i++) {
        	$phude = '';
        	
        	for ($k=0; $k < 15 ; $k++) { 
        	 	$phude .= Str::random(7).' ';
        	 } 
        	 $noidung = '';
        	 for ($k=0; $k < 150 ; $k++) { 
        	 	$noidung .= Str::random(7).' ';
        	 } 
        	DB::table('blog')->insert(
        		[
        			'tieude' => Arr::random($tieude_list),
        			'phude' => $phude,
        			'noidung' => $noidung,
        			'ad_pheduyet' => mt_rand(0,1),
        			'idUser' => mt_rand(7,55),
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        			'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        		]
        	);
        }


        Schema::enableForeignKeyConstraints();
    }
}
