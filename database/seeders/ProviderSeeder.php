<?php

namespace Database\Seeders;

use App\Models\Provider;

use Illuminate\Database\Seeder;
use Database\Factories\ProviderFactory;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::factory()->create([
            'provider' => 'google',
            'provider_id' => "1111111111",
            'user_id' => 1,
            'avatar' => 'https://pyxis.nymag.com/v1/imgs/d29/4a6/d8b19f15856697769dc1c586d59ce82bd8-22-cat-video-truth-smoking.rsquare.w700.jpg',
        ]);
        
        Provider::factory()->create([
            'provider' => 'facebook',
            'provider_id' => "2222222222",
            'user_id' => 2,
            'avatar' => 'https://pbs.twimg.com/media/FV9ZEbZUAAAbwS2.jpg'
        ]);

        Provider::factory()->create([
            'provider' => 'google',
            'provider_id' => "3333333333",
            'user_id' => 3,
            'avatar' => 'https://www.rainforest-alliance.org/wp-content/uploads/2021/06/capybara-square-1.jpg.optimal.jpg',
        ]);
    }
}
