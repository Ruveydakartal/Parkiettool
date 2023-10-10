<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;
    protected $table = 'users_status'; // Name of the database table
    public $timestamps = false;

    protected $fillable = [
        'status',
        'user_id',
        'date',
        'payment_data'
    ];
    
}
