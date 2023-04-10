<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        // permissions for admin
        $permission_users_all = Permission::create(['name' => 'users.*']);
        $permission_contents_all = Permission::create(['name' => 'contents.*']);
        $permission_questions_all = Permission::create(['name' => 'questions.*']);
        $permission_comments_all = Permission::create(['name' => 'comments.*']);

        // permissions for moderators
    // $permission_contents_all = Permission::create(['name' => 'contents.*']);
    //  $permission_questions_all = Permission::create(['name' => 'questions.*']);
        $permission_comments_create_delete = Permission::create(['name' => 'comments.create,delete']);

        // permissions for users


        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permission_users_all);
        $adminRole->givePermissionTo($permission_contents_all);
        $adminRole->givePermissionTo($permission_questions_all);
        $adminRole->givePermissionTo($permission_comments_all);

        $moderatorRole = Role::create(['name' => 'moderator']);
        $moderatorRole->givePermissionTo($permission_contents_all);
        $moderatorRole->givePermissionTo($permission_questions_all);
        $moderatorRole->givePermissionTo($permission_comments_create_delete);

        $userRole = Role::create(['name' => 'user']);


        $userAdmin = User::factory()->create([
            'email' => 'admin@adminmail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Admin',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('admin123')  
        ]);
        $userAdmin->assignRole($adminRole);


        $userErik = User::factory()->create([
            'email' => 'erik@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Erik',
            'bio' => 'My hobbies are reading and programming',      
            'password' => Hash::make('Jelszo123')  
        ]);
        $userErik->assignRole($moderatorRole);


        $userFeco = User::factory()->create([
            'name' => 'Fecó',
            'bio' => 'I play with guns',
            'email' => 'feco@fakemail.com',
            'email_verified_at' => Carbon::now(),
        ]);
        $userFeco->assignRole($moderatorRole);


        $userBence = User::factory()->create([
            'email' => 'bence@fakemail.com',
            'email_verified_at' => Carbon::now(),
            'name' => 'Bencus',
            'bio' => 'I\'m here for the money',
        ]);
        $userBence->assignRole($moderatorRole);
        
        User::factory()->count(15)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
