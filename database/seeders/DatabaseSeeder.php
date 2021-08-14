<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Tweet (has many replies) (belongs to thred) (belongs to user    )
        \App\Models\User::factory(20)->hasTweets(rand(5,10))->create();
       
        // $threads=Thread::with('user')->get();
        // $threads->each(function($t){
        //     Tweet::factory(rand(1,4))->create(['thread_id'=>$t->id,'user_id'=>$t->user->id]);
        // });

        $tweets=Tweet::all();
        $tweets->each(function($t){
            Reply::factory(rand(1,4))->create(['tweet_id'=>$t->id,'user_id'=>rand(1,20)]);
        });
        User::first()->follow(User::find(2));
        User::first()->follow(User::find(3));
        User::first()->follow(User::find(4));
        User::first()->follow(User::find(5));
        User::first()->follow(User::find(6));
        User::first()->update(['email'=>"a@a.com","name"=>"ahmed"]);
        User::find(2)->update(['email'=>"b@b.com","name"=>"mohamed"]);
        
    }
}
