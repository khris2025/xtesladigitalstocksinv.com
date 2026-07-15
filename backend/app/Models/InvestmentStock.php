<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_id',
        'fullname',
        'email',
        'amount',
        'profit',
        'shares',
        'status',
        'transid',
        'Withdrawaldate',
        'dateadd',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
