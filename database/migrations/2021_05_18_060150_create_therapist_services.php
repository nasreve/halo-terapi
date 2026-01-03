<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapistServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapist_services', function (Blueprint $table) {
            $table->id();
            $table->integer('therapist_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->bigInteger('rate')->nullable();
            $table->enum('status', ['Diterima', 'Ditolak'])->nullable();
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
        Schema::dropIfExists('therapist_services');
    }
}
