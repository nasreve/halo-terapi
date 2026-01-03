<?php

namespace App\Http\Requests\Patient;

use App\Rules\PhoneUniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SettingRequest extends FormRequest
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
        $input = $this->all();
        $input['password'] = trim($input['password']);
        $input['password_confirmation'] = trim($input['password_confirmation']);
        $this->replace($input);

        return [
            'name' => 'required',
            'date_of_birth' => 'bail|required|before:' . now()->addDay()->format('d-m-Y'),
            'gender' => 'required',
            'job' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'address' => 'required',
            'address_origin' => 'required',
            'business_community' => 'sometimes|required',
            'business_name' => 'sometimes|required',
            'business_address' => 'sometimes|required',
            'phone_number' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('patients', 'phone_number', $this->user('patient')->id)],
            'whatsapp_number' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('patients', 'whatsapp_number', $this->user('patient')->id)],
            'source' => 'required',
            'password' => 'bail|nullable|confirmed|min:8|required_with:password_confirmation',
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
            'date_of_birth' => 'tanggal lahir',
            'gender' => 'jenis kelamin',
            'job' => 'pekerjaan',
            'village' => 'kelurahan',
            'address' => 'detail alamat',
            'address_origin' => 'alamat asal',
            'business_community' => 'komunitas bisnis',
            'business_name' => 'nama usaha',
            'business_address' => 'alamat usaha',
            'phone_number' => 'nomor telepon',
            'whatsapp_number' => 'nomor whatsapp',
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
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.',
        ];
    }

    /**
     * Menghanlde jika pasien nekat mengganti email
     *
     * @return Illuminate\Validation\ValidationException
     */
    public function shouldNotUpdate()
    {
        if ($this->has('email')) {
            throw ValidationException::withMessages(['email' => 'Email tidak boleh diganti.']);
        }
    }
}
