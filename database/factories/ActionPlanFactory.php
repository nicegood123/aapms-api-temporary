<?php

namespace Database\Factories;

use App\Models\ActionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionPlanFactory extends Factory
{

    protected $model = ActionPlan::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'feedback_source_id' => $this->faker->randomElement([1,2,3]),
            'feedback' => $this->faker->sentence(),
            'actions_to_be_taken' => $this->faker->sentence(),
            'expected_compliance_period' => '2021-11-01 22:13:44',
            'status' => $this->faker->randomElement(['Complied', 'On-going', 'Delayed', 'Pending']),
            'expected_outcome' => $this->faker->sentence(),
            'means_of_verification' => $this->faker->text(),
            'person_in_charge_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'action_to_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'action_to' => $this->faker->randomElement(['College', 'Program']),
            'created_at' => $this->faker->dateTimeBetween('-1 years', '+211 days'),
            // 'created_at' => $this->faker->dateTime(),
            

        ];
    }
}
