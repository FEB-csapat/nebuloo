<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

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



        $userErik = User::factory()->create([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Erik',
            'bio' => 'My hobbies are reading and programming'
        ]);
        $userErik->assignRole($adminRole);
        
        
        $userFeco = User::factory()->create([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Fecó',
            'bio' => 'I play with guns'
        ]);
        $userFeco->assignRole($moderatorRole);
        

        $userBence = User::factory()->create([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Bencus',
            'bio' => 'I\'m here for the money'
        ]);
        $userBence->assignRole($userRole);
        
        /*
        DB::table('users')->insert([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Erik',
            'bio' => 'My hobbies are reading and programming'
        ]);
        
        DB::table('users')->insert([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Fecó',
            'bio' => 'I play with guns'
        ]);

        DB::table('users')->insert([
            'rank_id' => 1,
            'content_id' => null,
            'question_id' => null,
            'comment_id' => null,
            'vote_id' => null,

            'name' => 'Bencus',
            'bio' => 'I\'m here for the money'
        ]);
        */
    }
}
