<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusBuyToTableBillorder2d3d4d5d6ds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billorder2d3d4d5d6ds', function (Blueprint $table) {
            $table->integer('status_buy')->after('type_win')->default(0);
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
