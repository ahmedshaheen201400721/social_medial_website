<?php
namespace App\Support\Filter;

use App\Models\User;

class TweetFilter extends QueryFilter{


    public function by($name)
    {
        $this->query->where('user_id',(User::firstWhere('name',$name))->id);
    }

    public function popular($by='desc')
    {
        $this->query->getQuery()->orders=[];
        $this->query->orderBy('likes_count',$by)->orderBy('replies_count',$by);
    }

    public function recent($by='desc')
    {
        $this->query->getQuery()->orders=[];
        $this->query->orderBy('created_at',$by)->orderBy('replies_count',$by);
    }


}