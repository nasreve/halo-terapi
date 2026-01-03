<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
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
            'service_1' => 'sometimes|required',
            'service_2' => 'sometimes|required',
            'service_3' => 'sometimes|required',
            'service_4' => 'sometimes|required',
            'service_5' => 'sometimes|required',
            'service_6' => 'sometimes|required',
            'service_7' => 'sometimes|required',
            'service_8' => 'sometimes|required',
            'service_9' => 'sometimes|required',
            'service_10' => 'sometimes|required',
            'service_11' => 'sometimes|required',
            'service_12' => 'sometimes|required',
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
            'service_1.required' => 'Anda wajib memilih satu terapis pada layanan akupunktur pengobatan.',
            'service_2.required' => 'Anda wajib memilih satu terapis pada layanan akupunktur estetika.',
            'service_3.required' => 'Anda wajib memilih satu terapis pada layanan bekam.',
            'service_4.required' => 'Anda wajib memilih satu terapis pada layanan fisioterapi.',
            'service_5.required' => 'Anda wajib memilih satu terapis pada layanan fisioterapi anak.',
            'service_6.required' => 'Anda wajib memilih satu terapis pada layanan pijat bayi.',
            'service_7.required' => 'Anda wajib memilih satu terapis pada layanan totok wajah & aura.',
            'service_8.required' => 'Anda wajib memilih satu terapis pada layanan message.',
            'service_9.required' => 'Anda wajib memilih satu terapis pada layanan ortotik prostetik.',
            'service_10.required' => 'Anda wajib memilih satu terapis pada layanan terapi okupasi.',
            'service_11.required' => 'Anda wajib memilih satu terapis pada layanan terapi wicara.',
            'service_12.required' => 'Anda wajib memilih satu terapis pada layanan perawatan luka.',
        ];
    }
}
