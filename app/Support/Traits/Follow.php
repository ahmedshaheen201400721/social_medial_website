<?php

namespace App\Support\Traits;

use App\Models\User;

trait Follow{

    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }


    public function follow($user)
    {
        return $this->followers()->attach($user);
    }
    
    public function unfollow($user)
    {
        return $this->followers()->detach($user);
    }

    public function isfollowing($user)
    {
        return $this->followers()->where('follower_id',$user->id)->exists();
    }

    public function notFollowers()
    {
        // dd($this->followers()->pluck('follower_id'));
        return User::whereNotIn('id',$this->followers()->pluck('follower_id')->push($this->id));
    }

    public function toggle($user)
    {
        return $this->followers()->toggle($user);
    }
}