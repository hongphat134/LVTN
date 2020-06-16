<?php

use Illuminate\Database\Seeder;

class LoaiAdminsSeeder extends Seeder
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
        DB::table('loaiadmins')->truncate();
        
        $data = [
        	['ten' => 'tài khoản'],
        	['ten' => 'tin tuyển dụng'],
        	['ten' => 'hồ sơ'],
        	['ten' => 'report'],
        	['ten' => 'liên hệ'],
        	['ten' => 'quản trị viên'],
        ];

        foreach ($data as $v) {
        	DB::table('loaiadmins')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
