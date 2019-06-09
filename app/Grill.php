<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grill extends Model
{
    protected $table = 'grills';
    protected $appends = ['url_image'];

    public function renter(){
        return $this->belongsTo('App\User','user_id');
    }

    public function bookings(){
        return $this->hasMany('App\Booking','grill_id');
    }

    public function getUrlImageAttribute(){
        return route('grills.show_image',$this->image);
    }

    public function scopeIsWithinDistance($query, $coordinates, $radius = 5) {

        $haversine = "(6371 * acos(cos(radians(" . $coordinates['latitude'] . ")) 
                        * cos(radians(`latitude`)) 
                        * cos(radians(`longitude`) 
                        - radians(" . $coordinates['longitude'] . ")) 
                        + sin(radians(" . $coordinates['latitude'] . ")) 
                        * sin(radians(`latitude`))))";
    
        return $query->select()
                     ->selectRaw("{$haversine} AS distance")
                     ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
