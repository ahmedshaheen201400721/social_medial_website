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
    protected $with=['user'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getCreatedAtAttribute()
    {
        return (new Carbon($this->attributes['created_at']))->diffForHumans();
    }
}
