<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcdIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncd_issue_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('security_name')->nullable();

            $table->string('security_type')->nullable();
            
            $table->date('open_date')->nullable();

            $table->date('close_date')->nullable();

            $table->float('face_value')->nullable();

            $table->float('issue_price')->nullable();

            $table->float('issue_size_base')->nullable();

            $table->float('issue_size_shelf')->nullable();


            $table->string('listing_at')->nullable();

            $table->string('credit_rating')->nullable();


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
        Schema::dropIfExists('ncd_issue_details');
    }
}
