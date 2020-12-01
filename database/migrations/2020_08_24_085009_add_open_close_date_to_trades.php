<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpenCloseDateToTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dateTime('open_at', 0)->after('open_price')->nullable();
            $table->dateTime('closed_at', 0)->after('closed_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('open_at');
            $table->dropColumn('closed_at');
        });
    }
}
