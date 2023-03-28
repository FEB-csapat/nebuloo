<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Content;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            Content::factory()->create();
            Question::factory()->create();

            $commentableType = $this->faker->randomElement(['App\Models\Content', 'App\Models\Question']);
            $commentable = $commentableType === 'App\Models\Content' ? Content::inRandomOrder()->first() : Question::inRandomOrder()->first();

            $user = User::factory()->create();
            return [
                'creator_user_id' => /*User::inRandomOrder()->first()*/$user->id,
                'commentable_id' => $commentable->id,
                'commentable_type' => $commentableType,
                'parent_comment_id' => null,
                'message' => $this->faker->paragraph
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
}
