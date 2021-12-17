<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_no');
            $table->string('patient_ip');
            $table->string('patient_name');
            $table->string('age');
            $table->string('gender');
            $table->string('patient_mobile');
            $table->string('patient_email')->nullable();
            $table->string('patient_address')->nullable();
            $table->string('gurdian_name')->nullable();
            $table->string('schedule_id');
            $table->date('date');
            $table->string('type');
            $table->string('status')->default('0');
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
        Schema::dropIfExists('appointments');
    }
}
