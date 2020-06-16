<?php

use Illuminate\Database\Seeder;

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
            ['ten' => 'Tân', 'email' => 'tan@gmail.com', 'password' => '123456' ,'loaitk' => 1],
            ['ten' => 'Thành', 'email' => 'thanh@gmail.com', 'password' => '123789' ,'loaitk' => 0],
        
        ];

        foreach ($data as $v) {
        	DB::table('users')->insert(
        		[
        			'ten' => $v['ten'],
        			'email' => $v['email'],
        			'password' => bcrypt($v['password']),
        			'loaitk' => $v['loaitk'],
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        			'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
