<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coins')->insert(['symbol' => 'BTC', 'name' => 'Bitcoin', 'api_link' => 'bitcoin', 'price' => '19500']);
        DB::table('coins')->insert(['symbol' => 'ETH', 'name' => 'Ethereum', 'api_link' => 'ethereum', 'price' => '600']);
        DB::table('coins')->insert(['symbol' => 'XRP', 'name' => 'Ripple', 'api_link' => 'xrp', 'price' => '0.5']);
        DB::table('coins')->insert(['symbol' => 'BAT', 'name' => 'Basic Attention Token', 'api_link' => 'bat', 'price' => '0.2']);
        DB::table('coins')->insert(['symbol' => 'EOS', 'name' => 'EOS', 'api_link' => 'eos', 'price' => '2']);
        DB::table('coins')->insert(['symbol' => '0x', 'name' => 'ZRX', 'api_link' => 'zrx', 'price' => '0.25']);
        DB::table('coins')->insert(['symbol' => 'LINK', 'name' => 'Chainlink', 'api_link' => 'link', 'price' => '90']);
        DB::table('coins')->insert(['symbol' => 'XTZ', 'name' => 'Tezos', 'api_link' => 'tezos', 'price' => '8']);
        DB::table('coins')->insert(['symbol' => 'ATOM', 'name' => 'Cosmos', 'api_link' => 'atom', 'price' => '15']);
        DB::table('coins')->insert(['symbol' => 'XLM', 'name' => 'Stellar', 'api_link' => 'stellar', 'price' => '0.5']);
    }
}
