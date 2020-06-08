<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Invoice extends Model
{
    protected $fillable = ['invoice_number', 'invoice_date', 'order_id', 'booking_id', 'user_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
