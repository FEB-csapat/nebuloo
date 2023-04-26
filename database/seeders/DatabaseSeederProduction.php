<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeederProduction extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RankSeeder::class,
            UserSeeder::class,
            ContentSeeder::class,
            
        ]);
    }
}
