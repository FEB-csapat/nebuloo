<?php

namespace App\Permision;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Laravel\Socialite\Contracts\User as GoogleUser;

class PermissionHandler
{
    static $adminRole;
    static $moderatorRole;
    static $userRole;

    static function initialize(){
        // permissions for admin
        $permission_users_all = Permission::create(['name' => 'users.*']);
        $permission_contents_all = Permission::create(['name' => 'contents.*']);
        $permission_questions_all = Permission::create(['name' => 'questions.*']);
        $permission_comments_all = Permission::create(['name' => 'comments.*']);

        // permissions for moderators
        $permission_contents_all = Permission::create(['name' => 'contents.*']);
        $permission_questions_all = Permission::create(['name' => 'questions.*']);
        $permission_comments_all = Permission::create(['name' => 'comments.create,delete']);

        // permissions for users
        

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permission_users_all);
        $adminRole->givePermissionTo($permission_contents_all);
        $adminRole->givePermissionTo($permission_questions_all);
        $adminRole->givePermissionTo($permission_comments_all);

        $moderatorRole = Role::create(['name' => 'moderator']);
        $moderatorRole->givePermissionTo($permission_contents_all);
        $moderatorRole->givePermissionTo($permission_questions_all);
        $moderatorRole->givePermissionTo($permission_comments_all);

        $userRole = Role::create(['name' => 'user']);
    }
}
