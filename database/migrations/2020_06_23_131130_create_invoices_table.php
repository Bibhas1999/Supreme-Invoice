<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_no');
            $table->date('date');
            $table->string('doctor')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('report_status')->default(0)->comment('0=Pending,1=Delivered');
            $table->tinyInteger('status')->default(0)->comment('0=Pending,1=Approve');
            $table->string('created_by')->nullable();
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
