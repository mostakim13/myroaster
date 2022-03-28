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
        Schema::create('roaster_types', function (Blueprint $table) {
            $table->id();
            $table->integer('roaster_id')->unsigned()->index()->foreign()->references("id")->on("time_keepers")->onDelete("cascade");
            $table->string('roaster_type')->default('Unschedueled');
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
        Schema::dropIfExists('roaster_types');
    }
};
