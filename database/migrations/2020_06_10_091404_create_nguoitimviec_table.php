<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoitimviecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoitimviec', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('hinh')->nullable();
            $table->string('hoten')->nullable();
            $table->string('emaillienhe')->nullable();
            $table->string('sdtlienhe')->nullable();
            $table->string('nganh')->nullable();      
            $table->json('kinang')->nullable();
            $table->string('khuvuc')->nullable();            
            $table->date('ngaysinh')->nullable();
            $table->string('gioitinh')->nullable();
            $table->string('honnhan')->nullable();      
            $table->string('hinhthuc_lv')->nullable();      
            // $table->string('trangthai_lv')->nullable();      
            $table->string('bangcap')->nullable();      
            $table->string('capbac')->nullable();      
            $table->string('kinhnghiem')->nullable();     
            $table->string('mucluongmm')->nullable();
            $table->longText('muctieu')->nullable();      
            $table->json('ngoaingu')->nullable();
            $table->json('tinhoc')->nullable();
            $table->longText('sotruong')->nullable();
            $table->longText('thongtinthem')->nullable();

            $table->integer('luotxem')->default(0);
            // 0 là chưa dc admin phê duyệt và 1 thì ngược lại
            $table->tinyInteger('ad_pheduyet')->default(0);
            // 0 là chưa công khai, 1 là công khai => Người tìm việc tự quyết định
            $table->tinyInteger('congkhai')->nullable();

            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade');

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
        Schema::dropIfExists('nguoitimviec');
    }
}
