<?php

namespace App\Http\Requests\Therapist\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'edu_history' => 'required',
            'workshop_history' => 'required',
            'internship_experience' => 'required',
            'job_experience' => 'required'
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
            'edu_history' => 'riwayat pendidikan formal',
            'workshop_history' => 'riwayat seminar dan pelatihan',
            'internship_experience' => 'pengalaman praktik kerja lapangan',
            'job_experience' => 'pengalaman kerja'
        ];
    }
}
