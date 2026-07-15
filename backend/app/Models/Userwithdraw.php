<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userwithdraw extends Model
{
    protected $fillable = [
        'fullname', 'email', 'status', 'amount', 'ptype', 'transid', 'walletaddress','proof', 'fee', 'dateadd'
    ];
    protected $casts = [
        'dateadd' => 'datetime',
    ];
    use HasFactory;
}
