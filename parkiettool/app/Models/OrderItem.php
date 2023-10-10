<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\Ring;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function ring()
    {
        return $this->belongsTo(Ring::class);
    }

    protected $table = 'orders_items'; // Name of the database table

    protected $fillable = [
        'ring_id',
        'order_id',
        'amount',
    ];
}
