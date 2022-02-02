<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('wall_id');
            $table->json('blocked_users')->nullable();
            $table->json('suspect_words')->nullable();
            $table->string('hashtag')->default('pomme');
        });

        
        Schema::table('settings', function(Blueprint $table) {
            $table->foreign('wall_id')->references('id')->on('walls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
