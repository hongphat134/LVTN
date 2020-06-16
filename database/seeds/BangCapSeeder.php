<?php

use Illuminate\Database\Seeder;

class BangCapSeeder extends Seeder
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
        DB::table('bangcap')->truncate();
        
        $data = [        
        	['ten' => 'Lao động phổ thông'],        	
        	['ten' => 'Trung học'],        	
        	['ten' => 'Trung cấp'],        	
        	['ten' => 'Cao đẳng'],        	
        	['ten' => 'Đại học'],        	        	      	
        	['ten' => 'Cao học'],        	
            ['ten' => 'Chứng chỉ'],  
            ['ten' => 'Không yêu cầu'],            
        ];

        foreach ($data as $v) {
        	DB::table('bangcap')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
