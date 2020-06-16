<?php

use Illuminate\Database\Seeder;

class NganhNgheSeeder extends Seeder
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
        DB::table('nganhnghe')->truncate();
        
        $data = [
        	['ten' => 'Lập trình viên .NET'],
        	['ten' => 'Lập trình viên AngularJS'],        	
        	['ten' => 'Lập trình viên Back End'],
        	['ten' => 'Lập trình viên Android'],
        	['ten' => 'Lập trình viên C++'],
            ['ten' => 'Lập trình viên C#'],
        	['ten' => 'Lập trình viên Front End'],
        	['ten' => 'Lập trình viên iOS'],
        	['ten' => 'Lập trình viên SQL'],
        	['ten' => 'Quản trị cơ sở dữ liệu'],
        	['ten' => 'Kỹ sư cầu nối'],
        	['ten' => 'Lập trình viên Oracle'],
        	['ten' => 'Python Web Developer'],
        	['ten' => 'Lập trình viên Ruby'],
        	['ten' => 'Lập trình viên Unity'],
        	['ten' => 'Lập trình viên PHP'],
        	['ten' => 'Lập trình viên Embedded'],
        	['ten' => 'Lập trình viên Games'],
        	['ten' => 'Lập trình viên OOP'],
        	['ten' => 'Lập trình viên Python'],
        	['ten' => 'Full Stack Web Developer'],
        ];

        foreach ($data as $v) {
        	DB::table('nganhnghe')->insert(
        		[
        			'ten' => $v['ten'],        			        			
        			// 'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
