<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToBillorder2d3d4d5d6dsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billorder2d3d4d5d6ds', function (Blueprint $table) {
            $table->integer('status_win')->nullable()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billorder2d3d4d5d6ds', function (Blueprint $table) {
            //
        });
    }
}
