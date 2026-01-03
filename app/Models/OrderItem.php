<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi one to one dengan order
     *
     * @return void
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id')->withDefault();
    }

    /**
     * Mengambil order item dengan status order yang sudah selesai
     *
     * @param  string $order_by
     * @param  string $order_direction
     * @return void
     */
    public function getFinishedOrder($order_by = "created_at", $order_direction = "desc")
    {
        return $this->whereHas('order', function ($query) {
            $query->where('order_status', 'Selesai');
        })->with('order')->orderBy($order_by, $order_direction)->get();
    }
}
