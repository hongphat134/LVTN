<?php

use Illuminate\Database\Seeder;

class KiNangSeeder extends Seeder
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
        DB::table('kinang')->truncate();
        
        $data = [
        	['ten' => 'C language'],     
        	['ten' => 'C#'],        	
        	['ten' => 'C++'],        	
        	['ten' => 'Database'],        	
        	['ten' => '.NET'],        	
        	['ten' => 'Blockchain'],        	
        	['ten' => 'PHP'],        	
        	['ten' => 'Python'],        	
        	['ten' => 'Ruby'],        	
        	['ten' => 'Swift'],        	
        	['ten' => 'Angular'],        	
        	['ten' => 'Java'],        	
        	['ten' => 'Kotlin'],        	
        	['ten' => 'iOS'],        	
        	['ten' => 'React Native'],        	
        	['ten' => 'ReactJS'],        	
        	['ten' => 'AngularJS'],        	
        	['ten' => 'NodeJS'],  
        	['ten' => 'VueJS'],  
        	['ten' => 'Android'],        	
        	['ten' => 'JSON'],        	
        	['ten' => 'J2EE'],        	
        	['ten' => 'ASP.NET'],        	
        	['ten' => 'Tester'],        	
        	['ten' => 'Embedded'],        	        
        	['ten' => 'Designer'],        	
        	['ten' => 'Golang'],        	
        	['ten' => 'Javascript'],        	
        	['ten' => 'Scala'],        	
        	['ten' => 'Django'],        	
        	['ten' => 'Hybrid'],        	
        	['ten' => 'Magento'],        	
        	['ten' => 'Objective C'],        	
        	['ten' => 'Laravel'],        	
        	['ten' => 'Xamarin'],        	        	
        	['ten' => 'UI-UX'],        	
        	['ten' => 'Oracle'],        	
        	['ten' => 'OOP'],        	
        	['ten' => 'Spring'],        	
        ];

        foreach ($data as $v) {
        	DB::table('kinang')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
