<?php

namespace App\Http\Requests;

use App\Rules\ServicePrice;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class therapistRequest extends FormRequest
{
    /**
     * Menampilkan satu message saja untuk validation array
     *
     * @param  Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $array = $validator->errors()->toArray();
        $err = array();

        foreach ($array as $error) {
            foreach ($error as $sub_error) {
                array_push($err, $sub_error);
            }
        }

        throw ValidationException::withMessages(array_unique($err));
    }

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
        $rules = [
            'service_id.*'  => 'required',
            'rate.*'        => ['required', new ServicePrice()]
        ];

        foreach ($this->service_id as $service_id) {
            $rules["service.{$service_id}"] = 'required';
        }

        return $rules;
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rate.*.required' => 'Semua harga layanan wajib untuk diisi.',
            'service.*.required' => 'Semua status layanan wajib untuk diisi.'
        ];
    }
}
