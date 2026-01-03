<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'bank_name' => 'required',
            'bank_account' => 'required',
            'account_number' => 'required',
            'logo_path' => 'required'
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
            'bank_name' => 'nama bank',
            'bank_account' => 'atas nama',
            'account_number' => 'nomor rekening',
            'logo_path' => 'logo bank'
        ];
    }
}
