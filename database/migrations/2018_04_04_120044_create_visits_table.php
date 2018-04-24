<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('beacon_id');
            $table->unsignedInteger('user_id');
            $table->double('distance');
            $table->timestamps();

            $table->foreign('beacon_id')->references('id')->on('beacons');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropForeign('visits_beacon_id_foreign');
            $table->dropForeign('visits_user_id_foreign');

            $table->drop();
        });
    }
}
