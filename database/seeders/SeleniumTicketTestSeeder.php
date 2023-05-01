<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SeleniumTicketTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('tickets')->delete();

        $user = User::factory()->create([
            'id'=>1,
            'username' => "TestUser",
            'display_name' => "TestUser",
            'email' => "test.user@fakemail.com",
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Password@123')
        ]);
        $admin = User::factory()->create([
            'username' => "Admin",
            'display_name' => "Admin",
            'email' => "test.admin@fakemail.com",
            'bio' => 'My hobbies are reading and programming',
            'password' => Hash::make('Admin@123'),
            'role' => 'admin'
        ]);
        Ticket::factory()->create([
            'creator_user_id'=> 1,
            'body' => 'Open bug',
            'state'=>false,
            'id'=>1
        ]);
        Ticket::factory()->create([
            'creator_user_id'=> 1,
            'body' => 'Closed bug',
            'state'=>true,
            'id'=>2
        ]);
    }
}
