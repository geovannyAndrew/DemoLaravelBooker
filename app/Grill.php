<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grill extends Model
{
    protected $table = 'grills';
    protected $appends = ['url_image'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function bookings(){
        return $this->hasMany('App\Booking','grill_id');
    }

    public function getUrlImageAttribute(){
        return route('grills.show_image',$this->image);
    }
}
