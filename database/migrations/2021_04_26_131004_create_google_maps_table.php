<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_maps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->double('lat');
            $table->double('lng');
            $table->bigInteger('partner_id');
            $table->bigInteger('pr_id');
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
        Schema::dropIfExists('google_maps');
    }
}
