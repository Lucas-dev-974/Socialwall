<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FacebookWall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wall_id');
            $table->string('token');
            $table->json('facebook_datas');
            $table->string('username');
            $table->string('pages')->nullable();
            $table->timestamps();
        });

        Schema::table('facebook', function(Blueprint $table){
            $table->foreign('wall_id')->references('id')->on('walls')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facebook', function (Blueprint $table) {
            $table->drop();
        });
        // Schema::dropIfExists('facebook');
    }
}
