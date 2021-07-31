<?php

namespace App\Models;

use App\Support\Filter\QueryFilter;
use App\Support\Traits\Likeable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory,Likeable;
    public $guarded=[];
    public $appends=['path','is_liked','can','is_subscribed'];
    protected $with=['user',"likes"];
   
    public static function boot()
    {
        parent::boot();
        static::deleting(function($tweet){
            $tweet->replies->each->delete();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
  

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function latestReply()
    {
        return $this->hasOne(Reply::class)->latestOfMany();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function subscribe($userId=null){
        $this->subscriptions()->create(['user_id'=>$userId?:auth()->id()]);
   }
   public function unsubscribe($userId=null){
       $this->subscriptions()->where('user_id',$userId?:auth()->id())->delete();
   }
   
   public function getIsSubscribedAttribute(){
    return  $this->subscriptions()->where('user_id',auth()->id())->exists();
   }

   public function subscribedUsers(){
     return $this->belongsToMany(User::class,'subscriptions','tweet_id','user_id')
         ->withTimestamps();
   }
   
    public function getCreatedAtAttribute()
    {
        return (new Carbon($this->attributes['created_at']))->diffForHumans();
    }

    public function getPathAttribute()
    {
        return route('tweets.show',$this);
    }
    public function getCanAttribute()
    {
        return auth()->user()->can('update',$this);
    }
    public function scopeFilter($query,QueryFilter $filter)
    {
        return $filter->apply($query);
    }

    public function wasJustPublished()
    {
       $latest= new Carbon($this->created_at);

        return $latest->gt(Carbon::now()->subSeconds(20));
    }
}

