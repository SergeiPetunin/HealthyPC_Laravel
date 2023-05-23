<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $table = 'service_requests';
    public $timestamps = true;

    protected $fillable = [
        'clientName',
        'aadress',
        'phone',
        'email',
        'description',
        'status',
        'user_id',
        'created_at'
    ];
}
