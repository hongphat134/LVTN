<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        
        $data = [            
        	['ten' => 'Phát', 'email' => 'phat@gmail.com', 'password' => '456789' ,'loaitk' => 1],            
            ['ten' => 'Thiện', 'email' => 'thien@gmail.com', 'password' => '456789' ,'loaitk' => 1],
            ['ten' => 'Tuấn', 'email' => 'tuan@gmail.com', 'password' => '456789' ,'loaitk' => 1],
            ['ten' => 'Tú', 'email' => 'tu@gmail.com', 'password' => '456789' ,'loaitk' => 1],
            ['ten' => 'Long', 'email' => 'long@gmail.com', 'password' => '456789' ,'loaitk' => 1],
            ['ten' => 'Tân', 'email' => 'tan@gmail.com', 'password' => '123456' ,'loaitk' => 2],            
            ['ten' => 'Thành', 'email' => 'thanh@gmail.com', 'password' => '123789' ,'loaitk' => 0],
        
        ];    

        foreach ($data as $v) {            
        	DB::table('users')->insert(
        		[
        			'ten' => $v['ten'],
        			'email' => $v['email'],
        			'password' => bcrypt($v['password']),
        			'loaitk' => $v['loaitk'],
                    'verified' => 1,
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        			'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        		]
        	);
        }
        // $ntd_name_list = array('FSoft','Grab','NFQ Asia','BOCASAY','Knorex','HARAVAN','LG Development Center Vietnam','Restaff','KPMG Digital Enablement','ZALORA Group','Netcompany','KMS Technology','Hybrid Technologies','Cinnamon AI Labs','Techbase Vietnam','AXON','Techcombank','OPSWAT');

        $name_list = array('Phát','Thiện','Tân','Thành','Tiến','Luân','Lương','Lộc','Tuấn','Hoà','Hưng','An','Anh','Khương','Thịnh','Thuận','Nhật','Đông','Hiếu','Khang','Khánh');
        // Random thêm NTV
        $count = 500;
        for ($i = 0 ; $i < $count ; $i++) {
            $name = Arr::random($name_list).' '.Arr::random($name_list); 
            $email = str_slug($name).'_'.Str::random(5).'@gmail.com';
            DB::table('users')->insert(
                [
                    'ten' => $name,
                    'email' => $email,
                    'password' => bcrypt('123789'),
                    'loaitk' => 0,
                    'verified' => 1,
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),                   
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                ]
            );
        } 

        Schema::enableForeignKeyConstraints();
    }
}
