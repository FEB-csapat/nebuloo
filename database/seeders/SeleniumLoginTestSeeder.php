<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SeleniumLoginTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com", 
            'email_verified_at' => Carbon::now(),     
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')  
        ]);
    }
}
