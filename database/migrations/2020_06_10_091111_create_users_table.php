<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->string('ten');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('loaitk')->nullable();
            $table->string('theodoi')->nullable();
            $table->string('theodoi_ntd')->nullable();
            $table->rememberToken();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable(); 
            $table->boolean('verified')->default(false);
            // $table->tinyInteger('verified')->default(0);
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
        Schema::dropIfExists('users');
    }
}
