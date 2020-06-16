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
        		'ten' => 'Adidas',
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
        ];

        foreach ($data as $v) {
        	DB::table('nhatuyendung')->insert(
        		[
        			'idUser' => $v['idUser'],
        			'ten' => $v['ten'],
        			'diachi' => $v['diachi'],
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
