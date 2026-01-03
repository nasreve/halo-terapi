<?php

namespace App\Http\Services;

class TherapistService
{
    /**
     * Mengambil status terapis
     *
     * @param  mixed $order
     * @return string
     */
    public static function getTherapistStatus($therapistStatus): string
    {
        if ($therapistStatus === "Disetujui") {
            return "<span class='tbr_label tbr_label-light-primary'>Disetujui</span>";
        }

        if ($therapistStatus === "Ditolak") {
            return "<span class='tbr_label tbr_label-light-danger'>Ditolak</span>";
        }

        if ($therapistStatus === "Menunggu") {
            return "<span class='tbr_label tbr_label-light-warning'>Menunggu</span>";
        }

        return "";
    }

    public static function getaddress($district, $regency): string
    {
        return "$district" . ", " . "$regency";
    }
}
