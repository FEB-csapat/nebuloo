<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\PermissionRegistrar;
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
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        
        $adminRole = Role::findOrCreate('admin');

        $moderatorRole = Role::findOrCreate('moderator');

        $userRole = Role::findOrCreate('user');
        

        $userAdmin = User::factory()->create([
            'email' => 'admin@adminmail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Admin',
            'display_name' => 'Admin',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('admin123')  
        ]);
        $userAdmin->assignRole('admin');


        $userErik = User::factory()->create([
            'email' => 'erik@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Erik',
            'display_name' => 'Erik',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('Jelszo123')  
        ]);
        $userErik->assignRole('moderator');


        $userFeco = User::factory()->create([
            'name' => 'Fecó',
            'display_name' => 'Fecó',
            'bio' => 'I play with guns',
            'email' => 'feco@fakemail.com',
            'email_verified_at' => Carbon::now(),
        ]);
        $userFeco->assignRole('moderator');


        $userBence = User::factory()->create([
            'email' => 'bence@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Bencus',
            'display_name' => 'Bencus',
            'bio' => 'I\'m here for the money',
        ]);
        $userBence->assignRole('moderator');
        
        User::factory()->count(15)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
