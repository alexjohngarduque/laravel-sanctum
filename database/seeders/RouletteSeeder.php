<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouletteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Roulette::factory(5)->create([ //generates 5 win output
            'photoURL' => fake()->url(),
            'textContent' => 'Win',
        ]);

        \App\Models\Roulette::factory(5)->create([ //generates 5 lose output
            'photoURL' => fake()->url(),
            'textContent' => 'Lose',
        ]);
    }
}
