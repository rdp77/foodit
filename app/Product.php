<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'image', 'slug', 'desc', 'list'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
