<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Ring extends Model
{
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

