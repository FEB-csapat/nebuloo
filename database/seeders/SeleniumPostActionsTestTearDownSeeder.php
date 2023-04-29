<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeleniumPostActionsTestTearDownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('contents')->delete();
        DB::table('questions')->delete();
        DB::table('comments')->delete();
    }
}
