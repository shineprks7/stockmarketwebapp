<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightMoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('right_more_infos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('review')->nullable();
            $table->text('subscription_details')->nullable();
            $table->text('objective_of_issue')->nullable();
            $table->text('company_financials')->nullable();

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
        Schema::dropIfExists('right_more_infos');
    }
}
