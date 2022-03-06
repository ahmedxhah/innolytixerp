<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->longText('subject');
            $table->integer('sub_total');
            $table->integer('discount');
            $table->integer('tax');
            $table->integer('grand_total');
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('officedetails_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('officedetails_id')->references('id')->on('office_details');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quotation');
    }
}
