<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $this->call(LoaiAdminsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(NhaTuyenDungSeeder::class);
        $this->call(TinTuyenDungSeeder::class);
        $this->call(NguoiTimViecSeeder::class);       
        $this->call(HoSoXinViecSeeder::class);       
        $this->call(BlogSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
