<?php

namespace App\Models;

use App\Support\Traits\Likeable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Likeable;
    public $appends=['is_liked','can'];
    protected $with=['likes'];

    public $guarded=[];
    
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::created(function($reply){
            $reply->tweet()->increment('likes_count');
        });

        static::deleting(function($reply){
            $reply->tweet()->decrement('likes_count');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tweet()
    {
        return $this->belongsTo(Tweet::class,'tweet_id');
    }

    public function getCreatedAtAttribute()
    {
        return (new Carbon($this->attributes['created_at']))->diffForHumans();
    }
    public function getCanAttribute()
    {
        return auth()->user()->can('update',$this);
    }

    public function wasJustPublished()
    {
       $latest= new Carbon($this->created_at);

        return $latest->gt(Carbon::now()->subSeconds(20));
    }
}
