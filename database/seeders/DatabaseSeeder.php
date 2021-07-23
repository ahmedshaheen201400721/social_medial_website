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
        // Tweet (has many replies) (belongs to thread) (belongs to user    )
        \App\Models\User::factory(30)->hasThreads(rand(5,10))->create();
       
        $threads=Thread::with('user')->get();
        $threads->each(function($t){
            Tweet::factory(rand(1,10))->create(['thread_id'=>$t->id,'user_id'=>$t->user->id]);
        });

        $tweets=Tweet::all();
        $tweets->each(function($t){
            Reply::factory(rand(0,10))->create(['tweet_id'=>$t->id,'user_id'=>rand(1,20)]);
        });
        User::first()->follow(range(2,6));
        
        
    }
}
