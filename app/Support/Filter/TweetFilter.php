<?php
namespace App\Support\Filter;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TweetFilter extends QueryFilter{

    public function thread($name)
    {
        $this->query->whereHas('thread',function(Builder $builder) use ($name){
            $builder->where('name',$name);
        });
    }

    public function by($name)
    {
        // dd();
        $this->query->where('user_id',(User::firstWhere('name',$name))->id);
    }
    public function popular($by='desc')
    {
        $this->query->getQuery()->orders=[];
        $this->query->orderBy('likes_count',$by)->orderBy('replies_count',$by);
    }


}