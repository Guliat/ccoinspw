<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 150; $i++) {
            DB::table('trades')->insert([
                'user_id' => 4,
                'exchange_id' => rand(1, 5),
                'coin_id' => rand(1, 20),
                'quantity' => rand(1, 100),
                'open_price' => rand(1, 15000),
            ]);
        }
    }
}
