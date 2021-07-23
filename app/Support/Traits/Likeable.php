<?php
namespace App\Support\Traits;

use App\Models\Like;

trait Likeable
{
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }
    
    public function togglelike(){
        if(!$this->likes()->where("user_id",auth()->id())->exists()){
            $this->likes()->create(['user_id'=>auth()->id()]);
            $this->increment('likes_count');
            return 'like';
        }
        $this->likes()->where('user_id',auth()->id())->delete();
        $this->decrement('likes_count');
        return 'dislike';


    }
    public function isLiked(){
        return $this->likes->where('user_id',auth()->id())->isNotEmpty();
    }
    public function likeCount(){
        return $this->likes->count();
    }
}
