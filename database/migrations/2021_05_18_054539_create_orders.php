<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('therapist_id')->nullable();
            $table->integer('referrer_id')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_age')->nullable();
            $table->string('buyer_gender')->nullable();
            $table->string('buyer_job')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_whatsapp')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_province')->nullable();
            $table->string('buyer_regency')->nullable();
            $table->string('buyer_district')->nullable();
            $table->string('buyer_sub_district')->nullable();
            $table->string('buyer_address')->nullable();
            $table->text('buyer_symptoms')->nullable();
            $table->enum('buyer_payment_method', ['Transfer', 'Cash'])->default('Transfer')->nullable();
            $table->string('buyer_bank_name')->nullable();
            $table->string('buyer_account')->nullable();
            $table->string('buyer_account_number')->nullable();
            $table->enum('payment_status', ['Belum Dibayar', 'Sudah Dibayar'])->default('Belum Dibayar')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->enum('order_status', ['Menunggu', 'Terjadwal', 'Selesai'])->default('Menunggu')->nullable();
            $table->bigInteger('transaction_amount')->nullable();
            $table->bigInteger('paid_amount')->nullable();
            $table->bigInteger('cashback_amount')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
