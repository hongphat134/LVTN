<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhatuyendungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhatuyendung', function (Blueprint $table) {            
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade');
            $table->string('ten')->nullable();
            $table->string('tenlh')->nullable();
            $table->string('email')->nullable();
            $table->string('sdt')->nullable();
            $table->string('diachi')->nullable();            
            $table->string('tinhthanhpho')->nullable();
            $table->string('quymodansu')->nullable();
            $table->string('vanhoaphucloi')->nullable();
            $table->string('website')->nullable();
            $table->string('hinh')->nullable();
            // Cần có 1 trường để phê duyệt nhà tuyển dụng
            // $table->tinyInteger('ad_pheduyet')->nullable();
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
        Schema::dropIfExists('nhatuyendung');
    }
}
