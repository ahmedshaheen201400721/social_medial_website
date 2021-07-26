<?php

namespace App\Support\Spam;

class BadWords{

    public $badwords=[
        'crab',
        'shit',
        "fuck",
        'bitch'
    ];

    public function detect($body)
    {
        foreach ($this->badwords as $word) {
            if(preg_match("/{$word}/i",$body,$badword)){
                return "you cannot use this word  ==> ".$badword[0];
            }   
        }
        return false;
    }
}