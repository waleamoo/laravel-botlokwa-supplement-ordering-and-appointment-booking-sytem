<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['booking_date', 'booking_time', 'user_id', 'service_id', 'session_id', 'status','booking_total'];
}
