<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::findOrCreate("history", "offical-subject");
        Tag::findOrCreate("math", "offical-subject");
        Tag::findOrCreate("german", "offical-subject");
        Tag::findOrCreate("english", "offical-subject");
        Tag::findOrCreate("science", "offical-subject");
        Tag::findOrCreate("geography", "offical-subject");


        Tag::findOrCreate("First World War", "offical-subject-history");
        Tag::findOrCreate("Second World War", "offical-subject-history");


        Tag::findOrCreate("1. grade", "grade");
        Tag::findOrCreate("2. grade", "grade");
        Tag::findOrCreate("3. grade", "grade");
        Tag::findOrCreate("4. grade", "grade");
    }
}
