<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderServicePart extends Model
{
    use HasFactory;
    protected $table = 'service_order_parts';

    protected $fillable = [
        'order_id',
        'service_id'
    ];

    public function orderservice()
    {
        return $this->belongsTo('App\Models\OrderService', 'order_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }
}
