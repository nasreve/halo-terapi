<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Setting;
use App\Models\TherapistService;
use App\Notifications\AdminOrderNotification;
use App\Notifications\PatientOrderNotification;
use App\Notifications\TherapistOrderNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class FormWizardService
{
    /**
     * Menjumlahkan total harga
     *
     * @param  array $service_ids
     * @param  array $therapist_ids
     * @return integer
     */
    public static function getTransactionAmount($service_ids, $therapist_ids)
    {
        if (!is_array($service_ids) && !is_array($therapist_ids))
            return null;

        $total = [];

        foreach ($service_ids as $index => $service) {
            $data = TherapistService::where([
                'therapist_id' => $therapist_ids[$index],
                'service_id' => $service
            ])->first();

            $total[] = optional($data)->rate;
        }

        return array_sum($total);
    }

    /**
     * Mengambil harga layanan terapis
     *
     * @param  integer $therapist_id
     * @param  integer $service_id
     * @return integer
     */
    public static function getTherapistRate($therapist_id, $service_id)
    {
        $data = TherapistService::where([
            'therapist_id' => $therapist_id,
            'service_id' => $service_id
        ])->first();

        return optional($data)->rate;
    }

    /**
     * Mengkalkulasi bayaran terapis
     *
     * @param  integer $rate
     * @return integer
     */
    public static function getTherapistFee($rate)
    {
        $therapistPercent = Setting::first()->therapist_fee;
        return $rate * $therapistPercent / 100;
    }

    /**
     * Mengkalkulasi bayaran vendor
     *
     * @param  integer $rate
     * @param  mixed $referrer
     * @return integer
     */
    public static function getVendorFee($rate, $referrer)
    {
        $vendor_percent = Setting::first()->vendor_fee;
        $referrer_percent = Setting::first()->referrer_fee;

        if ($referrer) {
            return $rate * $vendor_percent / 100;
        }

        return $rate * ($vendor_percent + $referrer_percent) / 100;
    }

    /**
     * Mengkalkulasi bayaran referrer
     *
     * @param  integer $rate
     * @param  mixed $referrer
     * @return integer
     */
    public static function getreRerrerFee($rate, $referrer)
    {
        $referrerPercent = Setting::first()->referrer_fee;

        if ($referrer) {
            return $rate * $referrerPercent / 100;
        }

        return null;
    }

    /**
     * Inisialisasi session pada step ke 2
     *
     * @return void
     */
    public static function initSession()
    {
        if (!session()->has('therapistRegencies'))
            session(['therapistRegencies' => collect()]);

        if (!session()->has('therapistDistricts'))
            session(['therapistDistricts' => collect()]);

        if (!session()->has('choosenTherapists'))
            session(['choosenTherapists' => collect()]);

        if (!session()->has('servicePages'))
            session(['servicePages' => collect()]);
    }

    /**
     * Menhapus semua data ketika submit untuk order dari landing
     *
     * @return void
     */
    public static function resetAllSession()
    {
        session()->forget([
            'referral_code',
            'servicePages',
            'choosenTherapists',
            'therapistRegencies',
            'therapistDistricts',
            'step3data'
        ]);

        session(['orderVisitor' => collect()]);
    }

    /**
     * Menhapus semua data ketika submit untuk order dari profil terapis
     *
     * @return void
     */
    public static function resetAllSessionTherapist()
    {
        session()->forget('referral_code');

        session([
            'therapistOrder' => collect(),
            'step2data' => new Order()
        ]);
    }

    /**
     * data pekerjaan pasien
     *
     * @return array
     */
    public static function jobData(): array
    {
        return [
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
        ];
    }

    /**
     * Mengambil id kabupaten berdasarkan id layanan.
     *
     * @param  mixed $service_id
     * @return void
     */
    public static function getRegencyId($service_id)
    {
        $therapistRegencies = session('therapistRegencies');
        $therapistRegency = $therapistRegencies->where('service_id', $service_id)->first();

        return array_key_exists('regency_id', Arr::wrap($therapistRegency)) ? $therapistRegency['regency_id'] : auth()->guard('patient')->user()->regency_id;
    }

    /**
     * Mengambil id kabupaten berdasarkan id layanan.
     *
     * @param  mixed $service_id
     * @return void
     */
    public static function getDistrictId($service_id)
    {
        $therapistDistricts = session('therapistDistricts');
        $therapistDistrict = $therapistDistricts->where('service_id', $service_id)->first();

        return array_key_exists('district_id', Arr::wrap($therapistDistrict)) ? $therapistDistrict['district_id']: null;
    }

    /**
     * Menjumlahkan total harga
     *
     * @return int
     */
    public static function getTotalPrice(): int
    {
        $amount = 0;

        foreach (session('choosenTherapists') as $therapist) {
            $amount += optional(TherapistService::where('therapist_id', $therapist->therapist_id)->where('service_id', $therapist->service_id)->first())->rate;
        }

        return $amount;
    }

    /**
     * Mengirim email order ke admin
     * jika metode pembayaran transfer
     *
     * @param  mixed $data
     * @return void
     */
    public static function sendEmail($order)
    {
        Mail::to(config('mail.admin'))->queue(new AdminOrderNotification($order));
        Mail::to($order->buyer_email)->queue(new PatientOrderNotification($order));

        if ($order->buyer_payment_method === "Cash") {
            Mail::to($order->therapist->email)->queue(new TherapistOrderNotification($order));
        }
    }
}
