<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'               =>  fake()->unique()->numberBetween($min = 1, $max = 10),
            'player_type_id'        =>  fake()->numberBetween($min = 1,$max = 2),
            'life'                  =>  fake()->numberBetween($min = 0,$max = 100),
            'attack_points'         =>  fake()->numberBetween($min = 0, $max = 100),
            'defense_points'        =>  fake()->numberBetween($min = 0, $max = 100)
        ];
    }
}
