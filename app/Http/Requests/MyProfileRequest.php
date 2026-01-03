<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyProfileRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . auth()->user()->id,
            'password'  => 'bail|nullable|required_with:password_confirmation|min:8|confirmed'
        ];
    }

    /**
     * custom attributes name
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'name' => 'nama anda',
            'password' => 'password'
        ];
    }

    /**
     * Custom Message
     *
     * @return void
     */
    public function messages()
    {
        return [
            'email.email' => 'Alamat email harus benar.',
            'email.unique'  => 'Alamat email sudah digunakan oleh pengguna lain.'
        ];
    }
}
