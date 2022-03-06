<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipo_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('issue_type');
            
            $table->date('open_date');

            $table->date('close_date');

            $table->float('face_value');
            $table->float('issue_price');

            $table->float('issue_price_max')->nullable();
          

            $table->string('listing_at')->nullable();

            $table->string('offer_for_sale')->nullable();
            $table->string('qib_shares')->nullable();
            $table->string('retail_shares')->nullable();
            $table->string('nii_shares')->nullable();

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
        Schema::dropIfExists('ipo_details');
    }
}
