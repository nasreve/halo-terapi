<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PhoneUniqueRule implements Rule
{
    protected $table_name;
    protected $column_name;
    protected $except;
    protected $except_column;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table_name, $column_name, $except = NULL, $except_column = "id")
    {
        $this->table_name = $table_name;
        $this->column_name = $column_name;
        $this->except = $except;
        $this->except_column = $except_column;
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
        $newValue = ltrim($value, "0"); // menghapus 0 didepan angka
        $data = DB::table($this->table_name)
            ->where($this->column_name, $newValue)
            ->when($this->except, function ($query) {
                return $query->where($this->except_column, '!=', $this->except);
            });

        if (!$data->exists()) {
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
        return ':Attribute sudah digunakan oleh pengguna lain.';
    }
}
