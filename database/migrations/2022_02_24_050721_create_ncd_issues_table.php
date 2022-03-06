<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNcdIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncd_issues', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('company_name');
            $table->string('logo_url')->nullable();
            $table->text('about');
            $table->text('address')->nullable();
            $table->text('assumed_open_date')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('ncd_issues');
    }
}
