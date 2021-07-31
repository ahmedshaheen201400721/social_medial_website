<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Tweet;
use App\Rules\Spam;
use App\Support\Filter\TweetFilter;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(TweetFilter $filters)
    {
        // if(request()->all()){
        //     $tweets=Tweet::filter($filters)->get();
        // }else{
        //     $tweets=auth()->user()->timeline();
        // }
        $tweets=auth()->user()->timeline()->filter($filters)->get();



        // dd($tweets);

        // $friends=auth()->user()->followers()->get();
        return inertia('Dashboard',compact('tweets'));

    }

    public function delete(Tweet $tweet)
    {
        $tweet->delete();
        return 'deleted successfully';
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->body;
        $attributes=$request->validate(['body'=>['required','max:255',new Spam],],[],['body'=>'tweet']);
        $tweet=Tweet::create(['user_id'=>auth()->id(),"likes_count"=>0,"replies_count"=>0,'body'=>$request->body]);
        return $tweet->load('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        $tweet->load('replies');
        return inertia('Tweet/show',compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        $this->authorize('update',$tweet);
        $attributes=$request->validate(['body'=>['required','max:255',new Spam]],[],['body'=>'tweet']);
        $tweet->update(['body'=>$request->body]);
        $tweet=$tweet->refresh();
        return $tweet->load('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}
