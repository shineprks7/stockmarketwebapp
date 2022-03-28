<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpoLeadManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipo_lead_managers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('company_name');
            $table->string('logo_url')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('wesite')->nullable();
            $table->string('status')->nullable();
            $table->string('validity')->nullable();

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
        Schema::dropIfExists('ipo_lead_managers');
    }
}
