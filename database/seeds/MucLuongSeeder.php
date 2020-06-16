<?php

use Illuminate\Database\Seeder;

class MucLuongSeeder extends Seeder
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
        DB::table('mucluong')->truncate();
        
        $data = [        				
			['ten' =>'Dưới 3 triệu'],
			['ten' =>'3-5 triệu'],
			['ten' =>'5-7 triệu'],
			['ten' =>'7-10 triệu'],
			['ten' =>'10-12 triệu'],
			['ten' =>'12-15 triệu'],
			['ten' =>'15-20 triệu'],
			['ten' =>'20-25 triệu'],
			['ten' =>'25-30 triệu'],
			['ten' =>'35-40 triệu'],
			['ten' =>'40-50 triệu'],
			['ten' =>'Trên 50 triệu'],                 	      
        ];

        foreach ($data as $v) {
        	DB::table('mucluong')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
