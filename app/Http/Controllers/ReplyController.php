<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {

        $request->validate(['body'=>'required']);
        $reply= $tweet->replies()->create(
            ['body'=>$request->body,'user_id'=>auth()->id()]
        );
        $tweet->increment('replies_count');
        return $reply;
    }
}
