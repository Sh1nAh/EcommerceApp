<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'phone_number',
        'address',
        'township',
        'city',
        'notes',
        'payment_method',
        'payment_receipt',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
