<?php

namespace App\Support\Spam;

class Spam{
    public $checks=[
        RepeatedLetter::class,
        BadWords::class
    ];

    public function detect($body)
    {
        foreach ($this->checks as $class) {
            if(call_user_func([new $class,"detect"],$body)){
                return call_user_func([new $class,"detect"],$body);
            }
        }
        return false;
    }
}