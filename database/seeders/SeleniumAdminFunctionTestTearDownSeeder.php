<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Content;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SeleniumAdminFunctionTestTearDownSeeder extends Seeder
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
