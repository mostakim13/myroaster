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
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('employeeID');
            $table->string('clientID');
            $table->string('projectID');
            $table->string('projectStartDate');
            $table->string('projectEndDate');
            $table->string('roasterStartDate');
            $table->string('roasterEndDate');
            $table->string('duration');
            $table->string('ratePerHour');
            $table->string('amount');
            $table->string('remarks');
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
