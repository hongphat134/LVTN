<?php

use Illuminate\Database\Seeder;

class NhaTuyenDungSeeder extends Seeder
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
        DB::table('nhatuyendung')->truncate();
        
        $data = [
        	[
        		'idUser' => 1,
        		'ten' => 'Amazon',
        		'diachi' => 'HL2, P.BTD, Q.BT', 
        		'tinhthanhpho' => 'TP Hồ Chí Minh',
        		'quymodansu' => '20 - 150 người', 
        		'vanhoaphucloi' => 'Lương tháng 13',
        		'hinh' => 'amazon.jpg',
        	],     
            [
                'idUser' => 2,
                'ten' => 'Microsoft',
                'diachi' => 'HB, P.1, Q.11', 
                'tinhthanhpho' => 'TP Hồ Chí Minh',
                'quymodansu' => '150 - 300 người', 
                'vanhoaphucloi' => 'Lương tháng 13',
                'hinh' => 'microsoft.jpg',
            ],
            [
                'idUser' => 3,
                'ten' => 'Sprint',
                'diachi' => 'Cao Lỗ, P.14, Q.8', 
                'tinhthanhpho' => 'TP Hồ Chí Minh',
                'quymodansu' => '150 - 300 người', 
                'vanhoaphucloi' => 'Lương tháng 13',
                'hinh' => 'sprint.jpg',
            ],
            [
                'idUser' => 4,
                'ten' => 'Puma',
                'diachi' => 'Kinh Dương Vương, P.6, Q.6', 
                'tinhthanhpho' => 'TP Hồ Chí Minh',
                'quymodansu' => '150 - 300 người', 
                'vanhoaphucloi' => 'Lương tháng 13',
                'hinh' => 'puma.jpg',
            ],
            [
                'idUser' => 5,
                'ten' => 'Adidas',
                'diachi' => 'HB, P.1, Q.11', 
                'tinhthanhpho' => 'TP Hồ Chí Minh',
                'quymodansu' => '150 - 300 người', 
                'vanhoaphucloi' => 'Lương tháng 13',
                'hinh' => 'adidas.jpg',
            ],    	
        ];

        foreach ($data as $v) {
        	DB::table('nhatuyendung')->insert(
        		[
        			'idUser' => $v['idUser'],
        			'ten' => $v['ten'],
        			'diachi' => $v['diachi'],
                    'tenlh' => 'Liêu Thị Ánh Ngân',
                    'email' => 'hongphat701@gmail.com',
                    'sdt' => '0938933385',
        			'tinhthanhpho' => $v['tinhthanhpho'],
        			'quymodansu' => $v['quymodansu'],
        			'vanhoaphucloi' => $v['vanhoaphucloi'],
        			'hinh' => $v['hinh'],
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        			'updated_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
