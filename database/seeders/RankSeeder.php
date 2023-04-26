<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
            'name' => 'zöldfülű'
        ]);
        DB::table('ranks')->insert([
            'name' => 'okostojás'
        ]);
        DB::table('ranks')->insert([
            'name' => 'zseni'
        ]);
        DB::table('ranks')->insert([
            'name' => 'lángész'
        ]);
        DB::table('ranks')->insert([
            'name' => 'bölcs'
        ]);
    }
}
