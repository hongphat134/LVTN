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
            $table->string('kinang')->nullable();
            $table->string('nganh')->nullable();
            $table->string('mucluong')->nullable();
            $table->integer('soluong')->nullable();
            $table->string('bangcap')->nullable();
            $table->string('capbac')->nullable();
            // giờ hành chính or tại gia or overtime
            // $table->string('tinhchatcv')->nullable();
            // thực tập hoặc nhân viên chính thức
            // $table->string('hinhthuclv')->nullable();
            // Full time or Part time
            $table->string('trangthailv')->nullable();
            $table->string('tinhthanhpho')->nullable();

            $table->string('gioitinh')->nullable();            
            $table->string('kinhnghiem')->nullable();  
            //  3 tháng , 6 tháng or trao đổi trực tiếp khi phỏng vấn?
            // $table->string('tgthuviec')->nullable();
            $table->date('hantuyendung')->nullable();            
            $table->longText('motacv')->nullable();            
            $table->longText('quyenloi')->nullable();            
            // Thông tin liên hệ với cá nhân phụ trách đăng tin này
            // $table->longText('ttlienhe')->nullable();            
            $table->integer('idNTD')->unsigned();
            $table->foreign('idNTD')->references('idUser')->on('nhatuyendung')->onUpdate('cascade');
            $table->tinyInteger('congkhai')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
