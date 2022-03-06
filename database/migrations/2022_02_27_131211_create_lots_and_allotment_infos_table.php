<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsAndAllotmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots_and_allotment_infos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('minimum_lot')->nullable();

            $table->integer('maximum_lots')->nullable();

            $table->string('qib_allocation_ratio')->nullable();
            $table->string('nii_allocation_ratio')->nullable();
            $table->string('hni_allocation_ratio')->nullable();
            $table->string('rii_allocation_ratio')->nullable();

            $table->string('qib_offered')->nullable();
            $table->string('nii_offered')->nullable();
            $table->string('hni_offered')->nullable();
            $table->string('rii_offered')->nullable();

            $table->string('basis_of_allotment')->nullable();

            $table->string('allotment_status')->nullable();
            $table->text('allotment_comments')->nullable();


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
        Schema::dropIfExists('lots_and_allotment_infos');
    }
}
