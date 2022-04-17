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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('company_code');
            $table->string('address');
            $table->string('state');
            $table->string('status');
            $table->string('postal_code');
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->string('date_of_birth');
            $table->string('rsa_number')->nullable();
            $table->string('rsa_expire_date');
            $table->string('license_no')->nullable();
            $table->string('license_expire_date');
            $table->string('image')->nullable();
            $table->string('first_aid_license');
            $table->integer('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->unsignedInteger('userID');


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
        Schema::dropIfExists('employees');
    }
};
