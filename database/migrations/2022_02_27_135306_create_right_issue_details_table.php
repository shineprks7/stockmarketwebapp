<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('right_issue_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('security_name')->nullable();
            $table->float('issue_size_shares')->nullable();
            $table->float('issue_size_amount')->nullable();
            $table->date('open_date')->nullable();

            $table->date('close_date')->nullable();

            $table->float('face_value')->nullable();

            $table->float('issue_price')->nullable();

            $table->string('listing_at')->nullable();

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
        Schema::dropIfExists('right_issue_details');
    }
}
