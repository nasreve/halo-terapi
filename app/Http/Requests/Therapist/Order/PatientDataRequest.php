<?php

namespace App\Http\Requests\Therapist\Order;

use App\Rules\PhoneUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientDataRequest extends FormRequest
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
            'date_of_birth' => 'bail|required|before:' . now()->addDay()->format('d-m-Y'),
            'gender' => 'required',
            'job' => 'required',
            'phone_number' => ['bail', 'required', 'digits_between:7,14', session('no_create_user') === true ? "" : new PhoneUniqueRule('patients', 'phone_number')],
            'whatsapp_number' => ['bail', 'required', 'digits_between:7,14', session('no_create_user') === true ? "" : new PhoneUniqueRule('patients', 'whatsapp_number')],
            'email' => ['required', 'email', session('no_create_user') === true ? "" : 'unique:patients,email'],
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'address' => 'required',
            'symptoms' => 'required'
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
            'name' => 'nama lengkap',
            'date_of_birth' => 'tanggal lahir',
            'gender' => 'jenis kelamin',
            'job' => 'pekerjaan',
            'phone_number' => 'nomor telepon',
            'whatsapp_number' => 'nomor whatsapp',
            'village' => 'kelurahan',
            'address' => 'detail alamat',
            'address_origin' => 'alamat asal',
            'symptoms' => 'keluhan Anda'
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
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.',
        ];
    }
}
