<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_recommendations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('scrip');
            $table->string('action');
            $table->float('entryprice')->nullable();

            $table->float('target1');
            $table->float('target2');
            $table->float('stoploss');
            $table->string('status');

            $table->string('lotsize')->nullable();

            $table->string('tabname')->nullable();

            $table->string('subtabname')->nullable();

            $table->timestamp('recommendationdate')->nullable();

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
        Schema::dropIfExists('stock_recommendations');
    }
}
