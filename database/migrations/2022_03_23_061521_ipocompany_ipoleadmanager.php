<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IpocompanyIpoleadmanager extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ipocompany_ipoleadmanager', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('ipo_company_id');
            $table->unsignedBigInteger('ipo_lead_manager_id');
           

            $table->foreign('ipo_company_id')->references('id')->on('ipo_companies')->onDelete('cascade');
            $table->foreign('ipo_lead_manager_id')->references('id')->on('ipo_lead_managers')->onDelete('cascade');

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
        //
        Schema::dropIfExists('ipocompany_ipoleadmanager');

    }
}
