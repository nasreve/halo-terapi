<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ServicePrice implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $newValue = str_replace(".", "", $value);

        if ($newValue > 0) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Harga layanan tidak boleh kurang dari 0 rupiah.';
    }
}
