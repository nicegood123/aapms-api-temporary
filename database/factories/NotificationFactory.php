<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Read' ,'Unread']),
            'user_id' => $this->faker->randomElement([1000,2000,3000]),
        ];
       
    }
}
