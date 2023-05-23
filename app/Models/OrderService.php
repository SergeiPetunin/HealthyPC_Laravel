<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;
    protected $table = 'service_orders';

    protected $fillable = [
        'serviceData',
        'user_id',
        'clientName',
        'address',
        'phone',
        'email',
        'totalPrice'
    ];

    public function orderserviceparts()
    {
        return $this->hasMany('App\Models\OrderServicePart');
    }
}
