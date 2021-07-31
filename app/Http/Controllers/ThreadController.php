<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{


    public function index()
    {
        $threads=auth()->user()->threads()->get();
        return inertia("threads/index",compact('threads'));

    }


    public function show(Thread $thread)
    {
        $tweets=$thread->tweets;
        $thread=$thread->load('user');
        // return $thread->user;
        return inertia("threads/show",compact('thread','tweets'));
    }

   
}
