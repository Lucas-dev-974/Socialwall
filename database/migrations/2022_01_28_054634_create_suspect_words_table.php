<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuspectWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspect_words', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wall_id');
            $table->string('word');
            $table->timestamps();
        });

        Schema::table('suspect_words', function(Blueprint $table){
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
        Schema::dropIfExists('suspect_words');
    }
}
