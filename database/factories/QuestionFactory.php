<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subject = Subject::inRandomOrder()->first();
        $topic = $subject->topics()->inRandomOrder()->first();
        return [
            'title' => $this->faker->title,
            'body' => $this->faker->paragraph,
            'creator_user_id' => User::inRandomOrder()->first()->id,
            'subject_id' => $subject->id,
            'topic_id' => $topic != null ? $topic->id : null,
            
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
