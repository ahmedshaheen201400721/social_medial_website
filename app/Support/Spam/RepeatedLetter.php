<?php

namespace App\Support\Spam;

class RepeatedLetter{

    public function detect($body)
    {
        if(preg_match('#(.)\\1{3,}#i',$body,$badword)){
            return "you cannot use repeated word ==> ".$badword[0];
        }   
        return false;
    }
}