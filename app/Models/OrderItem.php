<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',  // Add this line
        'product_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // app/Models/OrderItem.php

public function product()
{
    return $this->belongsTo(Product::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
