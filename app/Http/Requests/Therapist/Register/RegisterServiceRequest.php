<?php

namespace App\Http\Requests\Therapist\Register;

use App\Rules\ServicePrice;
use Illuminate\Foundation\Http\FormRequest;

class RegisterServiceRequest extends FormRequest
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
            'rate.*' => ['required', new ServicePrice()],
            'regency' => 'required|array',
            'regency.*' => 'required',
            'district' => 'required|array',
            'district.*' => 'required',
            'homecare' => 'required',
            'equipment' => 'required',
            'max_duration' => 'required',
            'max_distance' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'homecare' => 'jadwal pelayanan home care',
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
            'rate.*.required' => 'Semua kolom harga layanan, yang Anda layani wajib untuk diisi.',
            'regency.*.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
            'district.*.required' => 'Kolom kabupaten dan kecamatan yang ada wajib untuk dipilih.',
        ];
    }
}
