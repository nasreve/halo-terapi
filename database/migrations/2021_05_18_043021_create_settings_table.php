<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->double('therapist_fee')->nullable();
            $table->double('vendor_fee')->nullable();
            $table->double('referrer_fee')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_account')->nullable();
            $table->text('transport_note')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
