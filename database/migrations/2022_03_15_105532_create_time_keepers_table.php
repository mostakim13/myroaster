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
            $table->string('company_code');
            $table->integer('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->integer('client_id')->unsigned()->index()->foreign()->references("id")->on("clients")->onDelete("cascade");
            $table->integer('project_id')->unsigned()->index()->foreign()->references("id")->on("projects")->onDelete("cascade");
            $table->integer('employee_id')->unsigned()->index()->foreign()->references("id")->on("employees")->onDelete("cascade");
            $table->integer('company_id')->unsigned()->index()->foreign()->references("id")->on("companies")->onDelete("cascade");
            $table->string('roaster_date');
            $table->string('shift_start');
            $table->string('shift_end');
            $table->string('sign_in')->nullable();
            $table->string('sign_out')->nullable();
            $table->string('duration');
            $table->string('ratePerHour');
            $table->string('amount');
            $table->integer('job_type_id')->unsigned()->index()->foreign()->references("id")->on("job_types")->onDelete("cascade");;
            $table->integer('roaster_id')->unsigned()->index()->foreign()->references("id")->on("roaster_statuses")->onDelete("cascade");;
            $table->integer('roaster_type')->unsigned()->index()->foreign()->references("id")->on("roaster_types")->onDelete("cascade");;
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
