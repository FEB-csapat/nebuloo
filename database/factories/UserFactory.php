<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the user's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->regexify('[A-Za-z0-9]{20}');
        return [
            'name' => $name,
            'display_name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'bio' => $this->faker->realText(200),
            'password' => Hash::make('Jelszo123@')
        ];
    }
}
