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

        // if ($validator->fails()) {
        //     return response($validator->errors(),401);
        // }
        $this->authorize('create',Reply::class);

        $reply= $tweet->replies()->create(
            ['body'=>$request->body,'user_id'=>auth()->id(),'likes_count'=>0]
        );
        return $reply;
    }

    public function delete(Reply $reply)
    {
        $reply->delete();
        return 'reply deleted successfully';
    }
}
