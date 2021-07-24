<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class LikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        return $tweet->togglelike();
    }
}
