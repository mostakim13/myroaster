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
            $table->unsignedInteger('Clientid');
            $table->unsignedInteger('Projectid');
            $table->unsignedInteger('Empid');
            $table->unsignedInteger('Companyid')->nullable();
            // $table->string('projectStartDate');
            // $table->string('projectEndDate');
            $table->string('Rodaterdate');
            $table->string('Shiftstart');
            $table->string('Shiftend');
            $table->string('Signon')->nullable();
            $table->string('Signoff')->nullable();
            $table->string('Duration');
            $table->string('Rate');
            $table->string('Amount');
            $table->unsignedInteger('Jobtypeid');
            $table->unsignedInteger('RoasterstatusID');
            $table->unsignedInteger('Roastertypeid');
            $table->string('Remarks')->nullable();
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
