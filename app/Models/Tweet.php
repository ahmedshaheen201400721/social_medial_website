<?php

namespace App\Models;

use App\Support\Traits\Likeable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory,Likeable;
    public $guarded=[];
    public $appends=['path'];
    protected $with=['user','thread'];
   
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
}
