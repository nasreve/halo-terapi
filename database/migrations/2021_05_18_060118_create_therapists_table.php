<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->charset("utf8")->collation("utf8_bin")->nullable();
            $table->string('photo_name')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('regency_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('village')->nullable();
            $table->text('address')->nullable();
            $table->text('address_origin')->nullable();
            $table->enum('religion', [
                'Islam',
                'Protestan',
                'Katolik',
                'Hindu',
                'Buddha',
                'Khonghucu',
            ])->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('year_of_graduate')->nullable();
            $table->string('str_number')->nullable();
            $table->string('job_place')->nullable();
            $table->string('job_hour')->nullable();
            $table->text('job_address')->nullable();
            $table->enum('source', [
                'Rekomendasi',
                'Voucher',
                'Google Maps',
                'WhatsApp',
                'Facebook',
                'Instagram',
                'TikTok',
                'YouTube',
                'Radio'
            ])->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('blocked')->default(0)->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->string('password')->nullable();
            $table->text('edu_history')->nullable();
            $table->text('workshop_history')->nullable();
            $table->text('internship_experience')->nullable();
            $table->text('job_experience')->nullable();
            $table->text('equipment')->nullable();
            $table->double('max_distance')->nullable();
            $table->double('max_duration')->nullable();
            $table->text('homecare')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('account_number')->nullable();
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu')->nullable();
            $table->integer('step')->default(1)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('therapists');
    }
}
