<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source'        => $this->faker->word(),
            'amount'        => $this->faker->randomFloat(2, 50, 1000),
            'description'   => $this->faker->sentence(3),
            'income_date'   => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
