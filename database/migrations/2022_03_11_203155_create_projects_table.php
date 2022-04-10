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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->string('pName');
            $table->string('cName');
            $table->string('status');
            $table->string('cNumber');
            $table->string('company_code');
            $table->string('clientName');
            $table->string('project_address')->nullable();
            $table->string('project_state')->nullable();
            $table->string('project_venue')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
