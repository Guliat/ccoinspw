<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Services\TradeService;

class TradeController extends Controller
{
	public $currentProfit;
	public $totalAvailable;
	public $totalQuantity;

	public function calculatedCollection($exchange = null, $coins = null)
	{
		$calc = new TradeService;
		$newCollection = collect();
		$trades = Trade::active()
					->when($exchange, function ($query, $exchange_id) {
						return $query->where('exchange_id', $exchange_id);
					})
					->when($coins, function ($query, $coins_ids) {
						return $query->whereIn('coin_id', $coins_ids);
					})
					->get();

		foreach ($trades as $trade) {
			$trade['paid'] = $calc->calculatePaid($trade->quantity, $trade->open_price);
			$this->currentProfit += $trade['profit'] = $calc->calculateProfit($trade->quantity, $trade->coin->price, $trade->open_price);
			$this->totalAvailable += $trade['available'] = $calc->calculateAvailable($trade->quantity, $trade->coin->price);
			$this->totalQuantity +=  $trade->quantity;
			$newCollection->push($trade);
		}

		return $newCollection;
	}

}
