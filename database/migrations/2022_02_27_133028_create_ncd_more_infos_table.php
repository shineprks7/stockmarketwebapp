<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcdMoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncd_more_infos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('ncd_review')->nullable();
            $table->text('subscription_details')->nullable();
            $table->text('objective_of_issue')->nullable();
            $table->text('company_financials')->nullable();

            $table->string('subscription_link')->nullable();


            $table->unsignedBigInteger('ncd_issue_id');


            $table->foreign('ncd_issue_id')->references('id')->on('ncd_issues')->onDelete('cascade');
            

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
        Schema::dropIfExists('ncd_more_infos');
    }
}
