<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_status' => 'required',
            'order_status' => 'required'
        ];
    }

    /**
     * Custom messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'payment_status.required' => 'Status pembayaran pasien wajib untuk di pilih.',
            'order_status.required' => 'Status persetujuan terapis wajib untuk di pilih.'
        ];
    }
}
