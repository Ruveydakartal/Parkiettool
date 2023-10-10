<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;


class User extends Model
{
    // relatie met orders met tussentabel orders_items
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

