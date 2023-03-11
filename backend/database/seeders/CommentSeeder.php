<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

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
            'vote_id' => 5,
            'commentable_id' => 1,
            'commentable_type' => 'content',
            'parent_comment_id' => null,
            'message' => "My opinion on the matter...",
        ]);
        
        Comment::factory()->create([
            'creator_user_id' => 2,
            'vote_id' => 6,
            'commentable_id' => 1,
            'commentable_type' => 'vote',
            'parent_comment_id' => 1,
            'message' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        ]);
    }
}