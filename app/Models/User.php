<?php

namespace App\Models;

use App\Support\Traits\Follow;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Follow;
    use Searchable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        "avatar",
        "path"
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class,'user_id');
    }

   
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class,'conversation_user');
    }


    public function latestTweet()
    {
        return $this->hasOne(Tweet::class)->latestOfMany();
    }

    public function threads()
    {
        return $this->hasMany(Thread::class,'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class,'user_id');
    }

    public function latestReply()
    {
        return $this->hasOne(Reply::class)->latestOfMany();
    }

    public function getAvatarAttribute()
    {
        return $this->profile_photo_url;
    }

    public function cover()
    {
        return $this->cover??"https://img.freepik.com/free-photo/dark-grey-black-slate-texture-with-high-resolution-background-natural-black-stone-wall_38607-444.jpg?size=626&ext=jpg";
    }
   
   
    public function timeline()
    {
        $ids=$this->followers()->pluck('follower_id');
        return Tweet::with('user')->where(function(Builder $query) use($ids){
             return $query->whereIn('user_id',$ids)->orWhere('user_id',$this->id) ;
        })->latest();
    }
    
    public function getPathAttribute()
    {
        return route('profil.show',$this);
        // return 'profil/'.$this->name;
    }
    public function getCreatedAtAttribute()
    {
        return (new Carbon($this->attributes['created_at']))->diffForHumans();
    }

    public function searchableAs()
    {
        return 'socail_users';
    }
}
