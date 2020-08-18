<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
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
        DB::table('comment')->truncate();

        $count = 10000;


        for ($i=0; $i < $count ; $i++) { 
        	$noidung = '';
        	for ($k=0; $k < 40 ; $k++) { 
        		$noidung .= Str::random(6).' ';
        	}
        	DB::table('comment')->insert(
        		[
        			'noidung' => $noidung,
        			'idBlog' => mt_rand(1,500),        		
        			'idUser' => mt_rand(7,55),
        			'created_at' => Carbon\Carbon::now()->toDateTimeString(),        			
        		]
        	);
        }


        Schema::enableForeignKeyConstraints();
    }
}
