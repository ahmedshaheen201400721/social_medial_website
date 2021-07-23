<?php

namespace App\Models;

use App\Support\Traits\Follow;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Follow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'cover',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be
     *  cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tweets()
    {
        return $this->hasMany(Tweet::class,'user_id');
    }
    


    public function avatar()
    {
        return $this->avatar;
    }
    public function cover()
    {
        return $this->cover;
    }

   
    public function timeline()
    {
        $ids=$this->followers()->pluck('follower_id');
        return Tweet::where(function(Builder $query) use($ids){
             return $query->whereIn('user_id',$ids)->orWhere('user_id',$this->id) ;
        })->latest()->get();
    }
    
    public function path()
    {
        return route('profile.show',$this);
    }
    
}

