<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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
    }
}
