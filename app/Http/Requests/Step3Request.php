<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step3Request extends FormRequest
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
            'buyer_name' => 'required',
            'buyer_age' => 'required',
            'buyer_gender' => 'required',
            'buyer_job' => 'required',
            'buyer_phone' => 'required|digits_between:7,14',
            'buyer_whatsapp' => 'required|digits_between:7,14',
            'buyer_email' => 'required|email',
            'buyer_province' => 'required',
            'buyer_regency' => 'required',
            'buyer_district' => 'required',
            'buyer_sub_district' => 'required',
            'buyer_address' => 'required',
            'buyer_symptoms' => 'required',
            'buyer_payment_method' => 'required'
        ];
    }

    /**
     * Custom attributes
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'buyer_name' => 'nama pasien',
            'buyer_age' => 'umur',
            'buyer_gender' => 'jenis kelamin',
            'buyer_job' => 'pekerjaan',
            'buyer_phone' => 'nomor telepon',
            'buyer_whatsapp' => 'nomor whatsapp',
            'buyer_email' => 'email',
            'buyer_province' => 'provinsi',
            'buyer_regency' => 'kabupaten',
            'buyer_district' => 'kecamatan',
            'buyer_sub_district' => 'kelurahan',
            'buyer_address' => 'detail alamat',
            'buyer_symptoms' => 'keluhan Anda',
            'buyer_payment_method' => 'jenis pembayaran'
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
            'buyer_email.email' => 'Alamat email harus benar.',
            'buyer_province.required' => 'Kolom provinsi wajib untuk dipilih.',
            'buyer_regency.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'buyer_district.required' => 'Kolom kecamatan wajib untuk dipilih.',
        ];
    }
}
