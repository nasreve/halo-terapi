<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class FeeRequest extends FormRequest
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
            'therapist_fee' => 'nullable|numeric',
            'vendor_fee' => 'nullable|numeric',
            'referrer_fee' => 'nullable|numeric'
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
            'therapist_fee' => 'terapis',
            'vendor_fee' => 'vendor',
            'referrer_fee' => 'referrer'
        ];
    }

    /**
     * Cek jika fee melebihi 100%
     *
     * @return void
     */
    public function is100Percent()
    {
        $totalFee = $this->input('therapist_fee') + $this->input('vendor_fee') + $this->input('referrer_fee');
        if ($totalFee > 100) {
            throw ValidationException::withMessages([
                'exceed' => 'Total fee tidak boleh lebih dari 100%.'
            ]);
        } elseif ($totalFee < 100) {
            throw ValidationException::withMessages([
                'exceed' => 'Total fee tidak boleh kurang dari 100%.'
            ]);
        }
    }
}
