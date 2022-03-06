<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpoTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipo_time_tables', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
         
            $table->date('open_date');

            $table->date('close_date');
            $table->date('allotment_date')->nullable();
            $table->date('refund_initiation')->nullable();
            $table->date('shares_to_demat')->nullable();
            $table->date('listing_date')->nullable();

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
        Schema::dropIfExists('ipo_time_tables');
    }
}
