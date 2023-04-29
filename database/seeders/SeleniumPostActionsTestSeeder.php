<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Question;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeleniumPostActionsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('contents')->delete();
        DB::table('questions')->delete();
        DB::table('comments')->delete();

        $user = User::factory()->create([
            'id'=>1,
            'name' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com",
            'email_verified_at' => Carbon::now(),
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')
        ]);
        $user->assignRole('user');
        Content::factory()->create([
            'creator_user_id' => $user->id,
            'body' => "Example content",
            'id'=>1
        ]);

        Question::factory()->create([
            'creator_user_id' => $user->id,
            'title'=> "Example title",
            'body' => "Example content",
            'id'=>1
        ]);

        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Content',
            'parent_comment_id' => null,
            'message' => "Test comment...",
        ]);
        Comment::factory()->create([
            'creator_user_id' => 1,
            'commentable_id' => 1,
            'commentable_type' => 'App\Models\Question',
            'parent_comment_id' => null,
            'message' => "Test comment...",
        ]);
    }
}
