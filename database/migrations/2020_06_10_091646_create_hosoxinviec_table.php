<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHosoxinviecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosoxinviec', function (Blueprint $table) {
            // Có số thuộc tính tối thiểu = ng` tìm việc
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('idTTD')->unsigned();
            $table->foreign('idTTD')->references('id')->on('tintuyendung')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hoten')->nullable();
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
            // 1 là chưa xem, 0 là xem rồi
            $table->boolean('new')->default(1);
            // 0 là chưa dc admin phê duyệt và 1 thì ngược lại
            $table->tinyInteger('trangthai')->nullable();            
            // các trường mong muốn         

            $table->rememberToken();            
            $table->timestamp('created_at');
                
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosoxinviec');
    }
}
