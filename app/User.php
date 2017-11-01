<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function categoryCosts(){
        return $this->hasMany(CategoryCost::class);
    }

    public function billReceives(){
        return $this->hasMany(BillReceive::class);
    }

    public function billPays(){
        return $this->hasMany(BillPay::class);
    }
}
