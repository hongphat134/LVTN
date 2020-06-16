<?php

use Illuminate\Database\Seeder;

class TinTuyenDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tintuyendung')->truncate();
        
        $data = [
        	[
        		'kinang' => '["1","2","3","4","5"]',
        		'nganh' => 'Lập trình viên Back End',
        		'soluong' => 20, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',  
        		'idNTD' => 1,        		
                'gioitinh' => 'Nam',
                'kinhnghiem' => 'Từ 1 đến 2 năm',
                'hantuyendung' => '2020-06-30',
                'bangcap' => 'Đại học',
                'mucluong' => 'Dưới 3 triệu',
                'motacv' => 'Lập trình server',
                'quyenloi' => 'Lương tháng 13',
                'trangthailv' => 'Full Time',
                'congkhai' => 1,
        	],
            [
                'kinang' => '["6","7","8","9","10"]',
                'nganh' => 'Lập trình viên Front End',
                'soluong' => 15, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',
                'idNTD' => 1,     
                'gioitinh' => 'Nam',
                'kinhnghiem' => 'Từ 2 đến 3 năm',
                'hantuyendung' => '2020-07-15',
                'bangcap' => 'Đại học',
                'mucluong' => '3-5 triệu',
                'motacv' => 'Lập trình client',
                'quyenloi' => 'Lương tháng 13',          
                'trangthailv' => 'Part Time',
                'congkhai' => 1,
            ], 
            [
                'kinang' => '["11","12"]',
                'nganh' => 'Lập trình viên C++',
                'soluong' => 10, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',         
                'idNTD' => 1,            
                'gioitinh' => 'Nam',
                'kinhnghiem' => 'Từ 2 đến 3 năm',
                'hantuyendung' => '2020-08-01',
                'bangcap' => 'Không yêu cầu',
                'mucluong' => '7-10 triệu',
                'motacv' => 'Lập trình nhúng',
                'quyenloi' => 'Lương tháng 13',   
                'trangthailv' => 'Full Time',
                'congkhai' => 1,
            ], 
            [
                'kinang' => '["16","17","18","19","20"]',
                'nganh' => 'Lập trình viên Android',
                'soluong' => 5, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',           
                'idNTD' => 1,               
                'gioitinh' => 'Nam',
                'kinhnghiem' => 'Từ 3 đến 4 năm',
                'hantuyendung' => '2020-06-30',
                'bangcap' => 'Cao đẳng',
                'mucluong' => '5-7 triệu',
                'motacv' => 'Lập trình Mobile',
                'quyenloi' => 'Lương tháng 13',
                'trangthailv' => 'Part Time',
                'congkhai' => 1,
            ], 
            [
                'kinang' => '["21","22","23","24"]',
                'nganh' => 'Lập trình viên Back End',
                'soluong' => 30, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',         
                'idNTD' => 2,               
                'gioitinh' => 'Bất kì',
                'kinhnghiem' => 'Từ 2 đến 3 năm',
                'hantuyendung' => '2020-07-30',
                'bangcap' => 'Cao đẳng',
                'mucluong' => '40-50 triệu',
                'motacv' => 'Lập trình server',
                'quyenloi' => 'Lương tháng 13',
                'trangthailv' => 'Full Time',
                'congkhai' => 1,
            ],
            [
                'kinang' => '["31","32","33"]',
                'nganh' => 'Lập trình viên OOP',
                'soluong' => 20, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',       
                'idNTD' => 2,               
                'gioitinh' => 'Bất kì',
                'kinhnghiem' => 'Từ 4 đến 5 năm',
                'hantuyendung' => '2020-07-30',
                'bangcap' => 'Cao học',
                'mucluong' => '15-20 triệu',
                'motacv' => 'Lập trình server',
                'quyenloi' => 'Lương tháng 13',
                'trangthailv' => 'Part Time',
                'congkhai' => 1,
            ],
            [
                'kinang' => '["13"]',
                'nganh' => 'Lập trình viên C#',
                'soluong' => 10, 
                'tinhthanhpho' => '["TP Hồ Chí Minh","Hà Nội","Đà Nẵng"]',              
                'idNTD' => 2,               
                'gioitinh' => 'Nam',
                'kinhnghiem' => 'Trên 5 năm',
                'hantuyendung' => '2020-08-30',
                'bangcap' => 'Đại học',
                'mucluong' => 'Trên 50 triệu',
                'motacv' => 'Lập trình server',
                'quyenloi' => 'Lương tháng 13',
                'trangthailv' => 'Part Time',
                'congkhai' => 1,
            ],
        ];

        foreach ($data as $v) {
        	DB::table('tintuyendung')->insert(
        		[
        			'kinang' => $v['kinang'],
        			'nganh' => $v['nganh'],
        			'tinhthanhpho' => $v['tinhthanhpho'],
        			'soluong' => $v['soluong'],
                    'gioitinh' => $v['gioitinh'],
                    'kinhnghiem' => $v['kinhnghiem'],
                    'mucluong' => $v['mucluong'],
                    'bangcap' => $v['bangcap'],
                    'hantuyendung' => $v['hantuyendung'],
                    'trangthailv' => $v['trangthailv'],
                    'congkhai' => $v['congkhai'],
                    'motacv' => $v['motacv'],
                    'quyenloi' => $v['quyenloi'],
        			'idNTD' => $v['idNTD'],        			
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        			'updated_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }      

        Schema::enableForeignKeyConstraints();
    }
}
