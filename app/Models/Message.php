<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'message'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}