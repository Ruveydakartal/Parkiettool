<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ring;
use App\Models\OrderItem;


class Order extends Model
{

    protected $fillable = [
        'status', // Add any other fields you have in your fillable list
    ];
    // relatie met user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
