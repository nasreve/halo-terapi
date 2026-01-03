<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * variabel tidak mass asingment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relasi dengan one to one therapist
     *
     * @return void
     */
    public function therapist()
    {
        return $this->hasOne(Therapist::class, 'id', 'therapist_id')->withDefault([
            'name' => 'No data available',
            'str_number' => 'No data available'
        ]);
    }

    /**
     * Relasi one to one dengan patient
     *
     * @return void
     */
    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id')->withDefault();
    }

    /**
     * Relasi one to one dengan referrer
     *
     * @return void
     */
    public function referrer()
    {
        return $this->hasOne(Referrer::class, 'id', 'referrer_id')->withDefault();
    }

    /**
     * Relasi one to many dengan orderItems
     *
     * @return void
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * Mengambil order yang belum di bayar
     *
     * @return void
     */
    public function getUnpaidOrderCount()
    {
        return $this->where('payment_status', 'Belum Dibayar')->count();
    }

    /**
     * Menghapus 0 di depan attribute buyer_phone
     *
     * @param  mixed $value
     * @return void
     */
    public function setBuyerPhoneAttribute($value)
    {
        $this->attributes['buyer_phone'] = ltrim($value, "0");
    }

    /**
     * Menghapus 0 di depan attribute buyer_whatsapp
     *
     * @param  mixed $value
     * @return void
     */
    public function setBuyerWhatsappAttribute($value)
    {
        $this->attributes['buyer_whatsapp'] = ltrim($value, "0");
    }

    /**
     * Mengambil data referrer
     *
     * @return void
     */
    public function getReferrer()
    {
        if ($this->referrer_id) {
            return $this->referrer->getReferrerName();
        }

        return "";
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }
}
