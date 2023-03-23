<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        
    }

    public function withTitleAndBody()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => $this->faker->sentence,
                'body' => $this->faker->paragraph,
                'creator_user_id' => $this->faker->numberBetween(1, 3),
            ];
        });
    }
}
