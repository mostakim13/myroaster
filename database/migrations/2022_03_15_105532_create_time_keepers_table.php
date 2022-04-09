<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_keepers', function (Blueprint $table) {
            $table->integer('Timekeeperid')->autoIncrement();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('Project_id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('company_id')->nullable();
            // $table->string('projectStartDate');
            // $table->string('projectEndDate');
            $table->string('roaster_date');
            $table->string('shift_start');
            $table->string('shift_end');
            $table->string('Sign_in')->nullable();
            $table->string('sign_out')->nullable();
            $table->string('duration');
            $table->string('ratePerHour');
            $table->string('amount');
            $table->unsignedInteger('jobtypeid');
            $table->unsignedInteger('roaster_status_id');
            $table->unsignedInteger('roaster_type_id');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('time_keepers');
    }
};
