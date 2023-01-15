<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registrant>
 */
class RegistrantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'school' => $this->faker->randomElement(['SMK', 'SMA', 'MA']),
            'major' => $this->faker->randomElement(
                [
                    'Rekayasa Perangkat Lunak',
                    'Teknologi Informasi',
                    'Sistem Informasi',
                    'Bisnis Digital',
                    'Informatika',
                    'Data Science',
                ]
            ),
            'mean_smt_4' => $this->faker->randomFloat(1,70, 100),
            'mean_smt_5' => $this->faker->randomFloat(1,70, 100),
            'status' => $this->faker->randomElement(['graduated', 'not_graduated']),
        ];
    }
}
