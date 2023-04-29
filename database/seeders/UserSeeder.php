<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::factory()->create([
            'email' => 'admin@adminmail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Admin',
            'display_name' => 'Admin',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);


        $userErik = User::factory()->create([
            'email' => 'erik@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Erik',
            'display_name' => 'Erik',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('Jelszo123'),
            'role' => 'moderator'
        ]);


        $userFeco = User::factory()->create([
            'name' => 'Fecó',
            'display_name' => 'Fecó',
            'bio' => 'I play with guns',
            'email' => 'feco@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'role' => 'moderator'
        ]);


        $userBence = User::factory()->create([
            'email' => 'bence@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Bencus',
            'display_name' => 'Bencus',
            'bio' => 'I\'m here for the money',
            'role' => 'moderator'
        ]);
        $userBence->setRoleToModerator();
        
        User::factory()->count(15)->create();
    }
}
