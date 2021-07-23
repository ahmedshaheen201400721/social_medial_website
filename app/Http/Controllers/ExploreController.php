<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{

    public function index()
    {
        $notFollowers=auth()->user()->notFollowers()->latest()->get();
        // dd($notFollowers);
        return inertia('explore/index',compact('notFollowers')); 
    }


    public function users()
    {
        return auth()->user()->notFollowers()->latest()->paginate(5);
    }
}
