<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PaymentRule implements Rule
{
    /**
     * Transaction amount
     *
     * @var mixed
     */
    public $transaction_amount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($transaction_amount)
    {
        $this->transaction_amount = $transaction_amount;
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
        $integerValue = intval(str_replace('.', '', $value));

        if ($integerValue >= $this->transaction_amount) {
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
        return 'Jumlah dibayar tidak boleh kurang dari jumlah biaya.';
    }
}
