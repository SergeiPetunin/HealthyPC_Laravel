<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'orderData',
        'totalPrice',
        'user_id',
        'clientName',
        'address',
        'phone',
        'email'
    ];

    public function orderparts()
    {
        return $this->hasMany('App\Models\OrderPart');
    }
    
}
