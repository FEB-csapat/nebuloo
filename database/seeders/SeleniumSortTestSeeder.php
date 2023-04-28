<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeleniumSortTestSeeder extends Seeder
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

        $subject = Subject::where('name','Történelem')->first();
        $topic = Topic::where('subject_id', $subject->id)->where('name','1. világháború');
        $user = User::factory()->create([
            'name' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com", 
            'email_verified_at' => Carbon::now(),     
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')  
        ]);
        Content::factory()->create([
            'creator_user_id' => $user->id,
            'body' => "Example content",
            'subject_id'=>$subject->id,
            'topic_id'=>$topic->id,
            'id'=>1
        ]);
    }
}
