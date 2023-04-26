<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ticket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the ticket's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'creator_user_id' => User::inRandomOrder()->first()->id,
            'body' => $this->faker->paragraph,
            'state'=>  $this->faker->boolean()
        ];
    }
}
