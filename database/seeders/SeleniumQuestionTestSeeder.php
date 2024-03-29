<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeleniumQuestionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('questions')->delete();

        $user = User::factory()->create([
            'id' => 1,
            'username' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com",
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')
        ]);

        Question::factory()->create([
            'creator_user_id' => $user->id,
            'title' => "Example title",
            'body' => "Example content",
            'id'=>1
        ]);
    }
}
