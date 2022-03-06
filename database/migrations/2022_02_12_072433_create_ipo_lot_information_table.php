<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpoLotInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipo_lot_information', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
         
            $table->integer('lots');

            $table->integer('min_lot')->nullable();
            $table->integer('max_lot')->nullable();
            $table->integer('min_shares')->nullable();
            $table->integer('max_shares')->nullable();
            $table->float('min_cut_off')->nullable();
            $table->float('max_cut_off')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('ipo_company_id');


            $table->foreign('ipo_company_id')->references('id')->on('ipo_companies')->onDelete('cascade');
            
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
        Schema::dropIfExists('ipo_lot_information');
    }
}
