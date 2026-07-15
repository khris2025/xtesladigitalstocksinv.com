<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_name',
        'amount_share',
        'roi',
        'trading_period',
        'stock_logo',
    ];

    public function investments()
    {
        return $this->hasMany(InvestmentStock::class);
    }
}
