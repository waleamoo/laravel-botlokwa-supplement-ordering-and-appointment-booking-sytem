<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    protected $fillable = [
        'supplement_id',
        'supplement_name', 
        'supplement_price', 
        'supplement_price_old',
        'discount',
        'rating',
        'supplement_description',
        'supplement_pic',
        'supplement_category_id',
        'qty_in_stock'
    ];
}
