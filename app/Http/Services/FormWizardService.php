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
     * In NOMINAL mode: Returns the fixed price from Service model
     * In PERCENTAGE mode: Returns the rate from TherapistService pivot table
     *
     * @param  integer $therapist_id
     * @param  integer $service_id
     * @return integer
     */
    public static function getTherapistRate($therapist_id, $service_id)
    {
        $setting = Setting::first();
        if ($setting->use_service_fee_nominal) {
            $service = \App\Models\Service::find($service_id);
            return optional($service)->price ?? 0;
        }

        $data = TherapistService::where([
            'therapist_id' => $therapist_id,
            'service_id' => $service_id
        ])->first();

        return optional($data)->rate;
    }

    /**
     * Mengkalkulasi bayaran terapis
     * 
     * In NOMINAL mode: Returns the fixed therapist_commission from Service model
     * In PERCENTAGE mode: Returns rate * therapist_fee_percentage / 100
     *
     * @param  integer $rate
     * @param  integer|null $service_id
     * @return integer
     */
    public static function getTherapistFee($rate, $service_id = null)
    {
        $setting = Setting::first();

        if ($setting->use_service_fee_nominal && $service_id) {
            $service = \App\Models\Service::find($service_id);
            return optional($service)->therapist_commission ?? 0;
        }

        $therapistPercent = $setting->therapist_fee;
        return $rate * $therapistPercent / 100;
    }

    /**
     * Mengkalkulasi bayaran vendor (klinik)
     * 
     * In NOMINAL mode: Returns price - therapist_commission - referrer_fee
     * In PERCENTAGE mode: Returns rate * vendor_fee_percentage / 100
     *
     * @param  integer $rate
     * @param  mixed $referrer
     * @param  integer|null $service_id
     * @return integer
     */
    public static function getVendorFee($rate, $referrer, $service_id = null)
    {
        $setting = Setting::first();
        $vendor_percent = $setting->vendor_fee;
        $referrer_percent = $setting->referrer_fee;

        if ($setting->use_service_fee_nominal && $service_id) {
            $service = \App\Models\Service::find($service_id);
            $commission = optional($service)->therapist_commission ?? 0;
            $referrerFee = self::getreRerrerFee($rate, $referrer);

            return $rate - $commission - $referrerFee;
        }

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

        return array_key_exists('district_id', Arr::wrap($therapistDistrict)) ? $therapistDistrict['district_id'] : null;
    }

    /**
     * Menjumlahkan total harga
     * 
     * In NOMINAL mode: Sums Service->price for each chosen service
     * In PERCENTAGE mode: Sums TherapistService->rate for each chosen service
     *
     * @return int
     */
    public static function getTotalPrice(): int
    {
        $amount = 0;

        foreach (session('choosenTherapists') as $therapist) {
            $amount += self::getTherapistRate($therapist->therapist_id, $therapist->service_id) ?? 0;
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
