<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeaconProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacon_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('beacon_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->foreign('beacon_id')->references('id')->on('beacons');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beacon_products', function (Blueprint $table) {
            $table->dropForeign('beacon_products_beacon_id_foreign');
            $table->dropForeign('beacon_products_product_id_foreign');

            $table->drop();
        });
    }
}
