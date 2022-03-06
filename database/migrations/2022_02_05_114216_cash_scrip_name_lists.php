<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CashScripNameLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('cash_scrip_name_lists', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();

            $table->string('scripname');
            $table->string('scriptype');

            $table->string('column3')->nullable();
            $table->string('column4')->nullable();

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
        
        Schema::dropIfExists('cash_scrip_name_lists');

    }
}
