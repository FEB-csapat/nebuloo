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
            'name' => 'zöldfülű',
            'description' => '1 tananyag vagy 2 kérdés feltöltése vagy 5 upvote',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'name' => 'okostojás',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'name' => 'lángész',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'name' => 'géniusz',
            'image' => 'placeholder'
        ]);
        DB::table('ranks')->insert([
            'name' => 'bölcs',
            'image' => 'placeholder'
        ]);
    }
}
