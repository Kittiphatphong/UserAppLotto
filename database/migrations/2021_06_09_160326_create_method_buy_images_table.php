<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodBuyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_buy_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('method_buy_id');
            $table->string('image');
            $table->timestamps();
            $table->foreign('method_buy_id')->references('id')->on('method_buys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('method_buy_images');
    }
}
