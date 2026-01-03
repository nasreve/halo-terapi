<?php

namespace App\Http\Services;

use App\Models\Referrer;

class ReferrerService
{
    /**
     * Menggenerate code unik referral
     *
     * @return void
     */
    public static function generateUniqueReff()
    {
        $unique_reff = 1000;
        $order = Referrer::where('unique_reff', $unique_reff)->first();

        while ($order) {
            $unique_reff = $unique_reff + 1;
            $order = Referrer::where('unique_reff', $unique_reff)->first();
        }

        return $unique_reff;
    }

    /**
     * Membuat statas referral
     *
     * @param  string $payment_status
     * @param  string $order_status
     * @return string
     */
    public static function getStatus($payment_status, $order_status)
    {
        if ($payment_status === "Sudah Dibayar" && $order_status === "Selesai") {
            return "<span class='tbr_label tbr_label-light-primary'>Berhasil</span>";
        }

        return "<span class='tbr_label tbr_label-light-danger'>Gagal</span>";
    }

    /**
     * Cek status referrer
     *
     * @param  mixed $referrer_id
     * @return mixed
     */
    public static function checkReferrerStatus($referrer_id)
    {
        if ($referrer_id === null) {
            return null;
        }

        $referrer = Referrer::with('patient', 'therapist')->where([
            'id' => $referrer_id,
            'blocked' => 0
        ])->first();

        if ($referrer === null) {
            return null;
        }

        if ($referrer->patient->blocked === 0) {
            return $referrer_id;
        }

        if ($referrer->therapist->blocked === 0 && $referrer->therapist->status === "Disetujui") {
            return $referrer_id;
        }

        return null;
    }
}
