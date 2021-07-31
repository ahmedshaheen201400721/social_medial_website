<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id'=>User::factory(),
            'body'=>$this->faker->paragraph(),
            'likes_count'=>0,
            "replies_count"=>0,
        ];
    }
}
