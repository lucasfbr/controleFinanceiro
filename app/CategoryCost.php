<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryCost extends Model
{
    protected $fillable = ['name','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billPay(){
        return $this->hasMany(BillPay::class);
    }

}
