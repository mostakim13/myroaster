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
        Schema::create('upcomingevents', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('project_name')->nullable();
            $table->string('event_date')->nullable();
            $table->string('shift_date')->nullable();
            $table->string('shift_end')->nullable();
            $table->string('rate')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('user_id')->nullable();
            $table->string('company_code')->nullable();
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
        Schema::dropIfExists('upcomingevents');
    }
};
