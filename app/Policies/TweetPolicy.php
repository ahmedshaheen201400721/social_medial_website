<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tweet $tweet)
    {
       return  $user->is($tweet->user);
        
    }

    public function create(User $user)
    {
       return $user->latestTweet?!$user->latestTweet->wasJustPublished():false;
    }

   
   

}
