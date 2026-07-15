<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kyc_verification extends Model
{
    protected $casts = [
        'dateadd' => 'datetime',
    ];
    use HasFactory;
}
