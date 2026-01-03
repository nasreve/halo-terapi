<?php

namespace App\Http\Requests\Therapist\Setting;

use App\Rules\PhoneUniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
        $input = $this->all();
        $input['password'] = trim($input['password']);
        $input['password_confirmation'] = trim($input['password_confirmation']);
        $this->replace($input);

        return [
            'name' => 'required',
            'str_number' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'address' => 'required',
            'address_origin' => 'required',
            'business_community' => 'sometimes|required',
            'business_name' => 'sometimes|required',
            'business_address' => 'sometimes|required',
            'religion' => 'required',
            'phone' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'phone', $this->user('therapist')->id)],
            'whatsapp' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'whatsapp', $this->user('therapist')->id)],
            'year_of_graduate' => 'required',
            'job_place' => 'nullable',
            'job_hour' => 'nullable',
            'job_address' => 'nullable',
            'source' => 'required',
            'password' => 'bail|nullable|confirmed|min:8|required_with:password_confirmation'
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
            'business_community' => 'komunitas bisnis',
            'business_name' => 'nama usaha',
            'business_address' => 'alamat usaha',
            'phone' => 'nomor telepon',
            'whatsapp' => 'nomor whatsapp',
            'year_of_graduate' => 'tahun lulus',
            'job_place' => 'nama tempat kerja',
            'job_hour' => 'jam kerja',
            'job_address' => 'alamat tempat kerja',
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

    /**
     * Menghanlde jika pasien nekat mengganti email atau username
     *
     * @return Illuminate\Validation\ValidationException
     */
    public function shouldNotUpdate()
    {
        $error = false;
        $messages = [];

        if ($this->has('email')) {
            $error = true;
            $messages['email'] = 'Email tidak boleh diganti.';
        }

        if ($this->has('username')) {
            $error = true;
            $messages['username'] = 'Username tidak boleh diganti.';
        }

        if ($error === true) {
            throw ValidationException::withMessages($messages);
        }
    }
}
