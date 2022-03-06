<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIpoDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('ipo_details', function (Blueprint $table) {
            //
           

            $table->string('issue_type')->nullable()->change();
            
            $table->date('open_date')->nullable()->change();

            $table->date('close_date')->nullable()->change();

            $table->float('face_value')->nullable()->change();
            $table->float('issue_price')->nullable()->change();
            $table->float('issue_size')->nullable();
            $table->float('assumed_start_date')->nullable();


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
    }
}
