<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    public $guarded=[];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }
}
