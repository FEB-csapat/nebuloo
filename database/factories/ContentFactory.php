<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the content's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subject = Subject::inRandomOrder()?->first() ?? Subject::factory()->create();
        $topic = Topic::where('subject_id', $subject->id)?->inRandomOrder()?->first()
            ?? Topic::factory()->create([
                'subject_id' => $subject->id
            ]);
        return [
            'body' => $this->faker->paragraph,
            'creator_user_id' => User::inRandomOrder()->first()->id,
            'subject_id' => $subject->id,
            'topic_id' => $topic->id,
            'created_at' => $this->faker->dateTimeBetween('-10 year', 'now'),
        ];
    }
}
