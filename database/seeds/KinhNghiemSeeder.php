<?php

use Illuminate\Database\Seeder;

class KinhNghiemSeeder extends Seeder
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
        DB::table('kinhnghiem')->truncate();
        
        $data = [        	
        	['ten' => 'Chưa có kinh nghiệm'],
            ['ten' => 'Dưới 1 năm'],
            ['ten' => 'Từ 1 đến 2 năm'],
            ['ten' => 'Từ 2 đến 3 năm'],
            ['ten' => 'Từ 3 đến 4 năm'],
            ['ten' => 'Từ 4 đến 5 năm'],
            ['ten' => 'Trên 5 năm'],              	      
        ];

        foreach ($data as $v) {
        	DB::table('kinhnghiem')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
