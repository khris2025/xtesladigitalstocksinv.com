<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investmentplan extends Model
{
    protected $fillable = [
        'fullname', 'email', 'amount', 'profit', 'plan', 'transid', 'Withdrawaldate', 'dateadd'
    ];
    protected $casts = [
        'dateadd' => 'datetime',
        'Withdrawaldate' => 'datetime',
    ];
    use HasFactory;
}
