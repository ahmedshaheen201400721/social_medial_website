<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Tweet;


class LikeController extends Controller
{
    public function store()
    {    
        $model=request('model')=="tweet"?Tweet::find(request('id')):Reply::find(request('id'));
        return $model->togglelike();
    }
}
