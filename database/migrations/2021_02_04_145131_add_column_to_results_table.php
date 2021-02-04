<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->char('d1');
            $table->char('d2');
            $table->char('d3');
            $table->char('d4');
            $table->char('d5');
            $table->char('d6');
            $table->unsignedBigInteger('animal6d_id')->after('l2d3d4d5d6d')->nullable();
            $table->unsignedBigInteger('animal1_id')->after('l2d3d4d5d6d')->nullable();
            $table->unsignedBigInteger('animal2_id')->after('l2d3d4d5d6d')->nullable();
            $table->unsignedBigInteger('animal3_id')->after('l2d3d4d5d6d')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            //
        });
    }
}
