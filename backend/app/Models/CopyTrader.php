<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyTrader extends Model
{

    protected $fillable = [
        'tradersname',
        'tradersimg',
        'return_rate',
        'followers',
        'profitshare',
    ];

    use HasFactory;
}
