<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Vote;
use Spatie\Permission\PermissionRegistrar;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::factory()->create([
            'owner_user_id' => 1,
            'reciever_user_id' => 2,
            'votable_id' => 1,
            'votable_type' => 'App\Models\Content',
            'direction' => 'up',
        ]);


        Vote::factory()->count(100)->create();
    }
}
