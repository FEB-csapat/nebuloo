<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('production')) {
            $this->call(DatabaseSeederProduction::class);
        }else if (App::environment('testing')) {
            $this->call(DatabaseSeederTesting::class);
        } else {
            $this->call(DatabaseSeederDevelopment::class);
        }
    }
}
