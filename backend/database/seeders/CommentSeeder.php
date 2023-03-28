<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Content',
            'parent_comment_id' => null,
            'message' => "My opinion on the matter...",
        ]);
        
        Comment::factory()->create([
            'creator_user_id' => 2,
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Question',
            'parent_comment_id' => null,
            'message' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);


        Comment::factory()->count(100)->create();
    }
}
