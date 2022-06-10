<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1000, 2000, 3000]),
            'action_plan_id' => $this->faker->randomDigit(),
            'content' => $this->faker->sentence(),
        ];
     
    }
}
