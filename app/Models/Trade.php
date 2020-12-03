<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    // use HasFactory;

    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * Users' active Trades
     *
     * Scope a query to only include active trades for user by ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     **/
    public function scopeActive($query)
    {
        return $query->where('user_id', auth()->id())->where('is_active', true);
    }
}
