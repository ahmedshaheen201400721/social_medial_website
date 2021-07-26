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
    public $appends=['path','is_liked','can'];
    protected $with=['user','thread',"likes"];
   
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
    public function thread()
    {
        return $this->belongsTo(Thread::class,'thread_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
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

