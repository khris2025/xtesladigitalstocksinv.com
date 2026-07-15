<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdeposit extends Model
{
    protected $fillable = [
        'fullname', 'email', 'status', 'amount', 'ptype', 'transid', 'proof', 'dateadd'
    ];
    protected $casts = [
        'dateadd' => 'datetime',
    ];
    use HasFactory;
}
