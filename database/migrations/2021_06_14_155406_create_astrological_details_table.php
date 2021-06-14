<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstrologicalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astrological_details', function (Blueprint $table) {
            $table->id();
            $table->json('digit');
            $table->string("image");
            $table->boolean("status")->default(false);
            $table->unsignedBigInteger('astrological_id');
            $table->foreign('astrological_id')->references('id')->on('astrologicals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('astrological_details');
    }
}
