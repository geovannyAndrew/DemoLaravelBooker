<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grill extends Model
{
    protected $table = 'grills';

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function bookings(){
        return $this->hasMany('App\Booking','grill_id');
    }
}
