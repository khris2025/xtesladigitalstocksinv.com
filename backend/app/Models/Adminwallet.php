<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminwallet extends Model
{
    protected $fillable = [
        'btc_address', 'eth_address', 'usdt_address', 'btc_address_qr', 'eth_address_qr', 'usdt_address_qr'
    ];
    use HasFactory;
}
