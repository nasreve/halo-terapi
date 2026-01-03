<?php

namespace App\Http\Services;

class BaseService
{
    /**
     * Membuat action button
     *
     * @param  mixed $id
     * @param  string $detailUrl
     * @param  string $deleteUrl
     * @return string
     */
    public static function getActionButton($id, string $detailUrl, string $deleteUrl): string
    {
        $iconSearch = asset('assets/svg/icon_search.svg');
        $iconTrash = asset('assets/svg/icon_trash.svg');

        return
            "<div class='actions'>
                <a href='{$detailUrl}' class='mr-1'>
                    <img src='{$iconSearch}' src='' />
                </a>
                <a href='javascript:void(0)' onclick='deleteData(event, `{$id}`, `{$deleteUrl}`)'>
                    <img src='{$iconTrash}' />
                </a>
            </div>";
    }

    /**
     * Mengambil status akun
     *
     * @param  mixed $order
     * @return string
     */
    public static function getAccountStatus($blocked): string
    {
        if ($blocked === 0) {
            return "<span class='tbr_label tbr_label-light-primary'>Active</span>";
        }

        if ($blocked === 1) {
            return "<span class='tbr_label tbr_label-light-danger'>Deactive</span>";
        }

        return "";
    }

    /**
     * Mengambil nomor whatsapp
     *
     * @param  mixed $whatsappNumber
     * @return string
     */
    public static function getPhoneNumber($whatsappNumber): string
    {
        $messageIcon = asset('assets/svg/icon_whatsapp.svg');

        $number =
            "<div class=\"actions\">
                <a href='" . Self::generateApi($whatsappNumber) . "'" . Self::getTarget($whatsappNumber) . "><img src=\"" . $messageIcon . "\"/></i></a>
            </div>";

        return $number;
    }

    /**
     * Convert nomor ke whatsapp link
     *
     * @param  mixed $number
     * @return string
     */
    private static function generateApi($number): string
    {
        if ($number) {
            return "https://api.whatsapp.com/send?phone=" . "62" . $number;
        }

        return "javascript:void(0)";
    }

    /**
     * Mengambil target link
     *
     * @param  mixed $number
     * @return void
     */
    private static function getTarget($number)
    {
        if ($number) {
            return "target='_blank'";
        }

        return "style='cursor: auto'";
    }

    /**
     * Menambahkan tooltip pada column datatable
     *
     * @param  string $sort_text
     * @param  string $long_text
     * @return string
     */
    public static function tooltipText($sort_text, $long_text)
    {
        return
            "<span
                data-toggle='tooltip'
                data-placement='left'
                title='{$long_text}'
            >{$sort_text}</>";
    }
}
