<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ranks')->insert([
            'user_id' => null,
            'name' => 'student',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'user_id' => null,
            'name' => 'smartass',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'user_id' => null,
            'name' => 'tutor',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'user_id' => null,
            'name' => 'teacher',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'user_id' => null,
            'name' => 'professor',
            'image' => 'placeholder'
        ]);
    }
}
