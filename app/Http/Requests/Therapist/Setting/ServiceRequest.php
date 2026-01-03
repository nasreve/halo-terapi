<?php

namespace App\Http\Requests\Therapist\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_id' => 'required|array|min:1',
            'regency' => 'required|array',
            'regency.*' => 'required',
            'district' => 'required|array',
            'district.*' => 'required',
            'equipment' => 'required',
            'max_duration' => 'required',
            'max_distance' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'equipment' => 'peralatan yang dimiliki',
            'max_duration' => 'waktu tempuh',
            'max_distance' => 'jarak'
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'service_id.required' => 'Anda wajib memilih minimal 1 layanan sesuai dengan keahlian yang Anda miliki.',
            'regency.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
            'district.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
            'regency.*.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
            'district.*.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
        ];
    }
}
