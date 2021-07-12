<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkMedthodBuysCategoryToMethodBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('method_buys', function (Blueprint $table) {
            $table->unsignedBigInteger('method_buy_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('method_buys', function (Blueprint $table) {
           $table->foreign('method_buy_category_id')->references('id')->on('method_buy_categories')->onDelete('cascade');
        });
    }
}
