<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTintuyendungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintuyendung', function (Blueprint $table) {
            $table->increments('id');
            $table->json('kinang')->nullable();
            $table->string('nganh')->nullable();
            $table->string('mucluong')->nullable();
            $table->integer('soluong')->nullable();
            $table->string('bangcap')->nullable();
            $table->string('capbac')->nullable();
            $table->string('hinhthuc_lv')->nullable();
            $table->json('tinhthanhpho')->nullable();
            $table->string('gioitinh')->nullable();            
            $table->string('kinhnghiem')->nullable();
            $table->json('ngoaingu')->nullable();
            $table->json('tinhoc')->nullable();  
            //  Nhận việc ngay, 1 tháng ,2 tháng, 3 tháng or trao đổi trực tiếp khi phỏng vấn?
            $table->string('tg_thuviec')->nullable();
            $table->date('hantuyendung')->nullable();            
            $table->json('motacv')->nullable();
            $table->longText('yeucau_cv')->nullable();            
            $table->json('quyenloi')->nullable();            
            // Thông tin liên hệ với cá nhân phụ trách đăng tin này
            $table->json('ttlienhe')->nullable();                        
            // 0 là đã xem, 1 là mới
            $table->integer('luotxem')->default(0);
            // $table->boolean('new')->default(1);
            $table->integer('idNTD')->unsigned();
            $table->foreign('idNTD')->references('idUser')->on('nhatuyendung')->onUpdate('cascade');
            $table->tinyInteger('ad_pheduyet')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tintuyendung');
    }
}
