<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'membership_name',
        'amount',
        'membership_id',
        'purchase_date',
        'expiry_date',
        'duration_days',
        'status',
    ];
}
