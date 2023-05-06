<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@fakemail.com',
            'username' => 'lacika33',
            'display_name' => 'Lajos',
            'bio' => 'Bélyegeket gyüjtök',
            'password' => Hash::make('Jelszo123!'),
            'role' => 'admin'
        ]);


        User::factory()->create([
            'email' => 'erik@fakemail.com',
            'username' => 'erikov123',
            'display_name' => 'Erik',
            'bio' => 'Szeretek olvasni meg ilyesmi...',      
            'password' => Hash::make('Jelszo123!'),
            'role' => 'moderator'
        ]);


        User::factory()->create([
            'username' => 'fecko123',
            'display_name' => 'Fecó',
            'bio' => 'Puskával játszok',
            'email' => 'feco@fakemail.com',
            'password' => Hash::make('Jelszo123!'),
            'role' => 'moderator'
        ]);


        User::factory()->create([
            'email' => 'bence@fakemail.com',
            'username' => 'bencus',
            'display_name' => 'Bencus',
            'bio' => 'Bence vagyok',
            'password' => Hash::make('Jelszo123!'),
            'role' => 'moderator'
        ]);


        User::factory()->create([
            'email' => 'anna@fakemail.com',
            'username' => 'annakiss',
            'display_name' => 'Anna',
            'bio' => 'Szeretek sportolni és utazni',
            'password' => Hash::make('Jelszo123!'),            
            'role' => 'user'
        ]);
        
        User::factory()->create([
            'email' => 'peter@fakemail.com',
            'username' => 'peterkozma',
            'display_name' => 'Péter',
            'bio' => 'IT szakember vagyok',
            'password' => Hash::make('Jelszo123!'),
            'role' => 'user'
        ]);
    
        User::factory()->create([
            'email' => 'dora@fakemail.com',
            'username' => 'dorika',
            'display_name' => 'Dóra',
            'bio' => 'Kertész vagyok és imádom a növényeket',
            'password' => Hash::make('Jelszo123'),
            'role' => 'user'
        ]);
    
        User::factory()->create([
            'email' => 'julcsi@fakemail.com',
            'username' => 'julcsika',
            'display_name' => 'Júlia',
            'bio' => 'Szeretek főzni és a gasztronómiával foglalkozni',
            'password' => Hash::make('Jelszo123'),
            'role' => 'user'
        ]);
    }
}
