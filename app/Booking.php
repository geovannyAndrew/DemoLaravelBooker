<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';


    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function grill(){
        return $this->belongsTo('App\Grill','grill_id');
    }

    public function renter(){
        return $this->grill->user;
    }
}
