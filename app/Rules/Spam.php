<?php

namespace App\Rules;

use App\Support\Spam\Spam as SpamSpam;
use Illuminate\Contracts\Validation\Rule;
// use \App\Support\Spam\Spam;

class Spam implements Rule
{
    public $msg="";
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
        if(resolve(SpamSpam::class)->detect($value)){
            $this->msg=resolve(SpamSpam::class)->detect($value);
        };
        return empty(resolve(SpamSpam::class)->detect($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
