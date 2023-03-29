<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'symbol' => 'AMZN',
            'number_of_shares' => fake()->randomFloat(5, 1, 1000),
        ];
    }

    public function suspended(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => $attributes['user_id'] ?? User::class->firstOrFail()->id,
            ];
        });
    }
}
