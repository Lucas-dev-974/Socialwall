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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wall_id');
            $table->string('name');
            $table->string('type');
            $table->longText('value');
        });

        
        Schema::table('settings', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        // Schema::table('settings', function (Blueprint $table) {
        //     $table->dropForeign(['user_id', 'wall_id']);
        //     $table->dropColumn('user_id');
        //     $table->dropColumn('wall_id');
        // });
        Schema::dropIfExists('settings');
    }
}
