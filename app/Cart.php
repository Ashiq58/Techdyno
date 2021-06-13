<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id','variations','qty'];

    public function product()
    {
        return$this->belongsTo(Product::class);
    }
}