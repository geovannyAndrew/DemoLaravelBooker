<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Booking;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role(){
        return $this->belongsTo('App\Role','role_id');
    }

    public function grills(){
        return $this->hasMany('App\Grill','user_id');
    }

    /**
     * Get aall booking from user
     */
    public function bookings(){
        return $this->hasMany('App\Booking','user_id');
    }

    /**
     * Get aall booking from renter
     */
    public function getBookingsRentedAttribute(){
        $grillIds = $this->grills()->pluck('id')->toArray();
        return Booking::whereIn('grill_id',$grillIds)->get();
    }


    public function getIsRenterAttribute(){
        return $this->role->name == 'RENTER';
    }

    public function getIsUserAttribute(){
        return $this->role->name == 'USER';
    }
}
