<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/tweets', [TweetController::class,"index"])->name('tweets.index');
    Route::post('/tweets',  [TweetController::class,"store"])->name('tweets.store');
    Route::get('/tweets/{tweet}', [TweetController::class,"show"])->name('tweets.show');


    Route::get('/explore', [ExploreController::class,'index'])->name('explore.index');
    Route::get('/notFriends',[ExploreController::class,'users'] )->name('notFriends');
    Route::post('/profile/{user:name}/follow',[FollowController::class,'store'])->name('follow.store');
    Route::post('/tweet/{tweet}/likes/create',[LikeController::class,'store'])->name('like.store');
    
    Route::get('/profile/{user:name}/edit',[ProfileController::class,'edit'])->name('profil.edit');
    Route::put('/profile/{user:name}',[ProfileController::class,'update'])->name('profil.update');
    Route::get('/profile/{user:name}',[ProfileController::class,'show'])->name('profil.show');


});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::redirect('/dashboard', "/tweets")->name('dashboard')->middleware(['auth:sanctum', 'verified']);
