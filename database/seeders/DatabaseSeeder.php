<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    
    DB::table('users')->insert([
      'name' => Str::random(10),
      'email' => Str::random(10) . '@gmail.com',
      'password' => Hash::make('password'),
    ]);

    $this->call([
      CoinsSeeder::class,
      ExchangesSeeder::class,
      TradesSeeder::class,
    ]);

  }
}
