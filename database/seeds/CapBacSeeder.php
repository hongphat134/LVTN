<?php

use Illuminate\Database\Seeder;

class CapBacSeeder extends Seeder
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
        DB::table('capbac')->truncate();
        
        $data = [
        	['ten' => 'Mới tốt nghiệp, thực tập sinh'],
        	['ten' => 'Nhân viên'],
        	['ten' => 'Trưởng nhóm'],
        	['ten' => 'Trưởng phòng'],
        	['ten' => 'Phó Giám đốc'],
        	['ten' => 'Giám đốc'],
        	['ten' => 'Tổng giám đốc điều hành'],        	      	        
        ];

        foreach ($data as $v) {
        	DB::table('capbac')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
