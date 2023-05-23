<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'image',
        'price',
        'warranty',
        'created_at'
    ];
    // ----------- связь с категориями по полю category_id - много к одному
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    //---- связи с обзорами
    public function rewiews()
    {
        return $this->hasMany('App\Models\Rewie');
    }

    public function orderpart() {
        return $this->hasMany('App\Models\OrderPart');
    }
}
