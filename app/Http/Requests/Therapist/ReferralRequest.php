<?php

namespace App\Http\Requests\Therapist;

use App\Rules\PhoneUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class ReferralRequest extends FormRequest
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
            'name' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'address' => 'required',
            'address_origin' => 'required',
            'business_community' => 'required',
            'business_name' => 'required',
            'business_address' => 'required',
            'phone' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'phone', $this->user('therapist')->id)],
            'whatsapp' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'whatsapp', $this->user('therapist')->id)],
            'source' => 'required',
            'bank_name' => 'required',
            'bank_account' => 'required',
            'account_number' => 'required'
        ];
    }

    /**
     * Custom attributes
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nama lengkap',
            'village' => 'kelurahan',
            'address' => 'detail alamat',
            'address_origin' => 'alamat asal',
            'business_community' => 'komunitas bisnis',
            'business_name' => 'nama usaha',
            'business_address' => 'alamat usaha',
            'phone' => 'nomor telepon',
            'whatsapp' => 'nomor whatsapp',
            'bank_name' => 'nama bank',
            'bank_account' => 'atas nama',
            'account_number' => 'nomor rekening'
        ];
    }

    /**
     * Cusom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.',
        ];
    }
}
