<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exchanges')->insert(['name' => 'Coinbase']);
        DB::table('exchanges')->insert(['name' => 'Binance']);
        DB::table('exchanges')->insert(['name' => 'HitBTC']);
        DB::table('exchanges')->insert(['name' => 'eToro']);
        DB::table('exchanges')->insert(['name' => 'Skrill']);
    }
}
