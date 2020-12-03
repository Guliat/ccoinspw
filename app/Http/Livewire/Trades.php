<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\TradeController;
use Illuminate\Support\Collection;

class Trades extends Component
{

    public Collection $user_coins; // All Coins
    public Collection $user_exchanges; // All Exchanges
    public Collection $user_trades; // All Trades
    public $current_profit;
    public $total_available;
    public $total_quantity;
    public $selectedExchange = 0;
    public $selectedCoins = [];

    public $trades_coins;
    public $user_coins_ids = [];
    public $trades_coins_ids;

    // public $sort;
    // public $direction = 'asc';



    public function mount()
    {
        $user = User::findOrFail(auth()->id());
        $this->user_coins = $user->activeCoins()->get();
        $this->user_exchanges = $user->activeExchanges()->get();
        $trades = new TradeController;
        $this->user_trades = $trades->calculatedCollection();
        $this->current_profit = $trades->currentProfit;
        $this->total_available = $trades->totalAvailable;
        $this->total_quantity = $trades->totalQuantity;

    }

      public function updatedSelectedExchange()
    {
        $trades = new TradeController;
        $this->user_trades = $trades->calculatedCollection($this->selectedExchange, $this->selectedCoins);

        $this->trades_coins_ids = $this->user_trades
                ->when($this->selectedExchange, function ($query) {
                    return $query->where('exchange_id', $this->selectedExchange);
                })->map(fn ($trade) => $trade->coin_id)->unique()->toArray();

        $user = User::findOrFail(auth()->id());
        $this->user_coins = $user->activeCoins()->whereIn('coin_id', $this->trades_coins_ids)->get();
        $this->current_profit = $trades->currentProfit;
        $this->total_available = $trades->totalAvailable;
        $this->total_quantity = $trades->totalQuantity;
    }

    public function updatedSelectedCoins()
    {
        $trades = new TradeController;
        $this->user_trades = $trades->calculatedCollection($this->selectedExchange, $this->selectedCoins);
        $this->current_profit = $trades->currentProfit;
        $this->total_available = $trades->totalAvailable;
        $this->total_quantity = $trades->totalQuantity;
    }

    public function render()
    {
        return view('livewire.trades');
    }
}