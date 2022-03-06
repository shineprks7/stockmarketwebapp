<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightsAllotDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rights_allot_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->integer('market_lot')->nullable();
            $table->integer('lots')->nullable();
            $table->float('lot_size')->nullable();
            $table->string('terms_payment')->nullable();
            $table->string('entitlement')->nullable();

            $table->date('record_date')->nullable();
            $table->date('date_of_allotment')->nullable();
            $table->date('renunciation_date')->nullable();

            $table->unsignedBigInteger('rights_issue_id');


            $table->foreign('rights_issue_id')->references('id')->on('rights_issues')->onDelete('cascade');
            
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
        Schema::dropIfExists('rights_allot_details');
    }
}
