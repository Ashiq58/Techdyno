<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  	protected $fillable = ['name','detail'];

	public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_variations', 'product_id', 'variation_id');
    }
}
