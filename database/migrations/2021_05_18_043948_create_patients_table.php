<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('job', [
                'Belum/Tidak Bekerja',
                'Akuntan',
                'Anggota Dewan',
                'Apoteker',
                'Arsitek',
                'Bidan',
                'Buruh Harian Lepas',
                'Buruh Nelayan / Perikanan',
                'Buruh Peternakan',
                'Buruh Tani / Perkebunan',
                'Dokter',
                'Dosen',
                'Guru',
                'Juru Masak',
                'Karyawan Swasta',
                'Konstruksi',
                'Konsultan',
                'Mekanik',
                'Mengurus Rumah Tangga / IRT',
                'Nelayan / Perikanan',
                'Notaris',
                'Pedagang',
                'Pelajar / Mahasiswa',
                'Pelaut',
                'Penata Rias',
                'Pengacara',
                'Penjahit',
                'Pensiunan',
                'Penyiar',
                'Perancang / Penata Busana',
                'Perangkat Desa',
                'Perawat',
                'Petani / Pekebun',
                'Peternak',
                'PNS',
                'Polisi',
                'Psikiater / Psikolog',
                'Sopir',
                'TNI',
                'Tukang Gigi',
                'Tukang Kayu',
                'Tukang Las / Pandai Besi',
                'Tukang Listrik',
                'Ustadz / Mubaligh',
                'Wartawan',
                'Wiraswasta',
                'Lainnya'
            ])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('regency_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('village')->nullable();
            $table->string('address')->nullable();
            $table->string('address_origin')->nullable();
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
            $table->string('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('blocked')->default(0)->nullable();
            $table->timestamp('blocked_at')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
