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
    	$this->call(LoaiAdminsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(NhaTuyenDungSeeder::class);
        $this->call(TinTuyenDungSeeder::class);
        $this->call(NganhNgheSeeder::class);
        $this->call(CapBacSeeder::class);
        $this->call(BangCapSeeder::class);
        $this->call(KiNangSeeder::class);
        $this->call(MucLuongSeeder::class);
        $this->call(KinhNghiemSeeder::class);
    }
}
