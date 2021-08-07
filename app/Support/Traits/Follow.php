<?php

namespace App\Support\Traits;

use App\Models\Conversation;
use App\Models\User;

trait Follow{

    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }


    public function follow($user)
    {
        $this->setupConversation($user);
        $user->followers()->attach($this);
        return $this->followers()->attach($user);
    }
    
    public function unfollow($user)
    {
        $user->followers()->detach($this);
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
    public function setupConversation($user)
    {
        if(!$this->sharedConversationId($user)){
            $conversation=Conversation::create(['name'=>$this->name."-".$user->name]);
            $user->conversations()->attach($conversation);
            $this->conversations()->attach($conversation);
        }    
    }
    public function sharedConversationId($user)
    {
        $conversations1=$user->conversations()->pluck('id');
        $conversations2=$this->conversations()->pluck('id');
        $intersection=$conversations1->intersect($conversations2);
        return $intersection->all();

    }

    public function sharedConversation($user)
    {
        $sharedConversationId=$this->sharedConversationId($user);
        return $sharedConversationId?Conversation::find($sharedConversationId[0]):"";

    }
    
}