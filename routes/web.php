<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\FollowController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Models\User;
use App\Support\Filter\TweetFilter;
use Illuminate\Support\Facades\Auth;

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
    //tweets
    Route::get('/tweets', [TweetController::class,"index"])->name('tweets.index');
    Route::post('/tweets',  [TweetController::class,"store"])->name('tweets.store');
    Route::get('/tweets/{tweet}', [TweetController::class,"show"])->name('tweets.show');
    Route::post('/tweets/{tweet}', [TweetController::class,"update"])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class,"delete"])->name('tweets.delete')->middleware("can:update,tweet");

    //replies
    Route::post('/tweets/{tweet}/replies', [ReplyController::class,"store"])->name('replies.store');
    Route::delete('/replies/{reply}', [ReplyController::class,"delete"])->name('replies.delete')->middleware("can:update,reply");
    Route::post('/replies/{reply}', [ReplyController::class,"update"])->name('replies.update')->middleware("can:update,reply");

    //explore
    Route::get('/explore', [ExploreController::class,'index'])->name('explore.index');
    Route::get('/notFriends',[ExploreController::class,'users'] )->name('notFriends');
    
    //profile
    Route::post('/profile/{user:name}/follow',[FollowController::class,'store'])->name('follow.store');    
    Route::get('/profile/{user:name}/edit',[ProfileController::class,'edit'])->name('profil.edit');
    Route::put('/profile/{user:name}',[ProfileController::class,'update'])->name('profil.update');
    Route::post('/profile/{user:name}/cover',[ProfileController::class,'updateCover'])->name('profil.cover');
    Route::get('/profile/{user:name}',[ProfileController::class,'show'])->name('profil.show');

    //subscribe
    Route::post('/tweets/{tweet}/subscribe',[\App\Http\Controllers\SubscriptionController::class,'store'])->name('subscription.store');
    Route::delete('/tweets/{tweet}/subscribe',[\App\Http\Controllers\SubscriptionController::class,'destroy'])->name('subscription.destroy');

    //likes
    Route::post('/likes/create',[LikeController::class,'store'])->name('like.store');
    //Notifications
    Route::get('/notifications/{user:id}',[\App\Http\Controllers\NotificationController::class,'show']);

    //search
    Route::post('/search',[\App\Http\Controllers\SearchController::class,'index']);

    //conversation
    Route::get('/conversation/{conversation:id}',[\App\Http\Controllers\ConversationController::class,'show']);
    //messages
    Route::get('/messages/{user:id}',[\App\Http\Controllers\MessageController::class,'index'])->name('messages.index');
    Route::post('/messages/{conversation}',[\App\Http\Controllers\MessageController::class,'store'])->name('messages.store');

    //APIs

    Route::get('/api/timeline',function(TweetFilter $filters){
        return $tweets=auth()->user()->timeline()->filter($filters)->paginate(5);
        // return $tweets=User::find(1)->timeline()->filter($filters)->paginate(5);
    });

    Route::get('/api/explore',function(){
    return auth()->user()->notFollowers()->latest()->paginate(5);
    });

    Route::get('/api/conversations/{user}',function(User $user){
    return auth()->user()->sharedConversation($user);
    });

});



Route::redirect('/', "tweets");
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
// });

Route::redirect('/dashboard', "/tweets")->name('dashboard')->middleware(['auth:sanctum', 'verified']);
