<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLimitRequestAndLimitInputToTableOTPS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('o_t_p_s', function (Blueprint $table) {
            $table->integer('limit_request')->default(0);
            $table->integer('limit_input')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('o_t_p_s', function (Blueprint $table) {
            //
        });
    }
}
