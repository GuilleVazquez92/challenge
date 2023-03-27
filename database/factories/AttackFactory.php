<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attack>
 */
class AttackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'attacker_id'       =>  fake()->numberBetween($min = 1, $max = 10),
            'defender_id'       =>  fake()->numberBetween($min = 1,$max = 10),
            'attack_type_id'    =>  fake()->numberBetween($min = 1,$max = 3),
            'damage'            =>  fake()->numberBetween($min = 0, $max = 100)
            
        ];
    }
}
