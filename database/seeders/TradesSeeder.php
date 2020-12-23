<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 6; $i++) {
            DB::table('exchange_user')->insert([
                'user_id' => 1,
                'exchange_id' => $i,
            ]);
        }

        for ($i = 1; $i < 11; $i++) {
            DB::table('coin_user')->insert([
                'user_id' => 1,
                'coin_id' => $i,
            ]);
        }


        for ($i = 0; $i < 50; $i++) {
            DB::table('trades')->insert([
                'user_id' => 1,
                'exchange_id' => rand(1, 5),
                'coin_id' => rand(1, 10),
                'quantity' => rand(1, 100),
                'open_price' => rand(1, 5000),
            ]);
        }

    }
}
