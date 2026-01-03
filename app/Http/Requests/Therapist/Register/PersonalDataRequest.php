<?php

namespace App\Http\Requests\Therapist\Register;

use App\Rules\PhoneUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class PersonalDataRequest extends FormRequest
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
        $therapist = auth()->guard('therapist')->user();

        return [
            'name' => 'required',
            'str_number' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'address' => 'required',
            'address_origin' => 'required',
            'religion' => 'required',
            'phone' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'phone', $therapist->id)],
            'whatsapp' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'whatsapp', $therapist->id)],
            'year_of_graduate' => 'required',
            'photo_path' => 'required',
            'job_place' => 'nullable',
            'job_hour' => 'nullable',
            'job_address' => 'nullable',
            'source' => 'required',
            'bank_name' => 'required',
            'bank_account' => 'required',
            'account_number' => 'required',
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
            'name' => 'nama dan gelar',
            'str_number' => 'nomor str',
            'village' => 'kelurahan',
            'address' => 'detail alamat',
            'address_origin' => 'alamat asal',
            'phone' => 'nomor telepon',
            'whatsapp' => 'nomor whatsapp',
            'year_of_graduate' => 'tahun lulus',
            'photo_path' => 'upload foto resmi',
            'job_place' => 'nama tempat kerja',
            'job_hour' => 'jam kerja',
            'job_address' => 'alamat tempat kerja',
            'bank_name' => 'nama bank',
            'bank_account' => 'atas nama',
            'account_number' => 'nomor rekening',
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'religion.required' => 'Kolom agama wajib untuk dipilih.',
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.',
        ];
    }
}
