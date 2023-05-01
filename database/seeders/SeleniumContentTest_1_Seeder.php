<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SeleniumContentTest_1_Seeder extends Seeder
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

        $user = User::factory()->create([
            'username' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com",
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')
        ]);

        Content::factory()->create([
            'creator_user_id' => $user->id,
            'body' => "Example content",
            'id'=>1
        ]);
    }
}
