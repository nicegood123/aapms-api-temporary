<?php

namespace Database\Factories;

use App\Models\FeedBackSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackSourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeedBackSource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
        ];

        
    }

}
