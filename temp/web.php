<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::loginUsingId(1);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/tweets', [TweetController::class,"index"])->name('tweets.index');
    Route::get('/explore', [ExploreController::class,'index'])->name('explore.index');
    Route::get('/notFriends',[ExploreController::class,'users'] )->name('notFriends');
    Route::post('/tweets',  [TweetController::class,"store"])->name('tweets.store');
    Route::post('/profile/{user:username}/follow',[FollowController::class,'store'])->name('follow.store');
    Route::post('/tweet/{tweet}/likes/create',[LikeController::class,'store'])->name('like.store');
    
    Route::get('/profile/{user:username}/edit',[ProfileController::class,'edit'])->name('profil.edit');
    Route::put('/profile/{user:username}',[ProfileController::class,'update'])->name('profil.update');
    Route::get('/profile/{user:username}',[ProfileController::class,'show'])->name('profil.show');


});
Route::get('/dashboard',function(){
    return "ahmed";
})->name('dashboard');



Route::get('test',fn()=>"ahmed");