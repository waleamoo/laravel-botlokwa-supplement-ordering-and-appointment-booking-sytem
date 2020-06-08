<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplementRating extends Model
{
    protected $fillable = ['supplement_id', 'user_id', 'rating', 'msg'];
}
