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
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade');
            $table->string('hinh')->nullable();
            $table->string('emaillienhe')->nullable();
            $table->string('nganh')->nullable();      
            $table->string('kinang')->nullable();
            $table->string('khuvuc')->nullable();            

            $table->string('honnhan')->nullable();      
            $table->string('trangthailv')->nullable();      
            $table->string('bangcap')->nullable();      
            $table->string('capbac')->nullable();      
            $table->string('kinhnghiem')->nullable();     
            $table->longText('muctieu')->nullable();      
            $table->longText('ngoaingu')->nullable();
            $table->longText('tinhoc')->nullable();
            $table->longText('sotruong')->nullable();
            $table->tinyInteger('trangthai')->nullable();

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
        Schema::dropIfExists('nguoitimviec');
    }
}
