<?php

use App\Models\User;
use App\Support\Filter\TweetFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return auth()->user();
});

Route::get('/timeline',function(TweetFilter $filters){
        return $tweets=auth()->user()->timeline()->filter($filters)->paginate(5);
        // return $tweets=User::find(1)->timeline()->filter($filters)->paginate(5);
});

Route::get('/explore',function(){
    return auth()->user()->notFollowers()->latest()->paginate(5);
});

Route::get('/conversations/{user}',function(User $user){
    return auth()->user()->sharedConversation($user);
});