<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\TradeController;
// use Illuminate\Support\Collection;

class Trades extends Component
{
    
    // COINS
    public $user_coins;
    public $user_coins_ids = [];
    public $selectedCoins = [];
    // EXCHANGES
    public $user_exchanges;
    public $selectedExchange = 0;
    // TRADES
    public $user_trades;
    public $current_profit;
    public $total_available;
    public $total_quantity;

 
    public function mount()
    {
        $user = User::findOrFail(auth()->id());
        $this->user_exchanges = $user->activeExchanges()->get();
        $this->getUserTrades();
        $this->getCoinsIds();
        $this->getUserCoins();
    }

    public function getCoinsIds()
    {
        $exchange_id = $this->selectedExchange;
        $this->user_coins_ids = $this->user_trades
            ->when($exchange_id, function ($query, $exchange_id) {
                return $query->where('exchange_id', $exchange_id);
            })
            ->map(fn ($trade) => $trade->coin_id)
            ->unique()
            ->toArray();
    }

    public function getUserTrades($exchange_id = null, $coins = null)
    {
        $trades = new TradeController;
        $this->user_trades = $trades->calculatedCollection($exchange_id, $coins);
        $this->current_profit = $trades->currentProfit;
        $this->total_available = $trades->totalAvailable;
        $this->total_quantity = $trades->totalQuantity;
    }

    public function getUserCoins()
    {
        $user = User::findOrFail(auth()->id());
        $this->user_coins = $user->activeCoins()->whereIn('coin_id', $this->user_coins_ids)->get();
    }

    public function selectExchange($exchange_id)
    {
        $this->selectedCoins = [];
        $this->selectedExchange = $exchange_id;
        $this->getUserTrades($exchange_id, $this->selectedCoins);
        $this->getCoinsIds();   
        $this->getUserCoins();
    }

    public function selectCoin($coin_id)
    {
        $this->selectedCoins[] = $coin_id;
        $this->getUserTrades($this->selectedExchange, $this->selectedCoins);
    }

    public function unselectCoin($coin_id)
    {
        if (($key = array_search($coin_id, $this->selectedCoins)) !== false) {
            unset($this->selectedCoins[$key]);
        }
        $this->getUserTrades($this->selectedExchange, $this->selectedCoins);
        $this->getCoinsIds();
        $this->getUserCoins();
    }

    public function clearSelectedCoins()
    {
        $this->selectedCoins = [];
        $this->getUserTrades($this->selectedExchange, $this->selectedCoins);
        $this->getCoinsIds();
        $this->getUserCoins();
    }

    public function render()
    {
        return view('livewire.trades');
    }
}