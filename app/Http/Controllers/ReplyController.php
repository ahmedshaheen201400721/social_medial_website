<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Tweet;
use App\Rules\Spam;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $validator = Validator::make($request->all(), [
            'body' => ['required',new Spam],
        ])->validate();

        $this->authorize('create',Reply::class);

        $reply= $tweet->replies()->create(
            ['body'=>$request->body,'user_id'=>auth()->id(),'likes_count'=>0]
        );
        return $tweet->latestReply;
    }

    public function delete(Reply $reply)
    {
        $reply->delete();
        return 'reply deleted successfully';
    }

    public function update(Request $request, Reply $reply)
    {
        $validator = Validator::make($request->all(), [
            'body' => ['required',new Spam],
        ])->validate();

        $reply->update(
            ['body'=>$request->body]
        );
        return $reply;
    }
}
