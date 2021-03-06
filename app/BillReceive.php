<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BillReceive extends Model
{
    protected $fillable = ['name','value','data_launch','user_id'];

    public function getDataLaunchAttribute($value){
        return  Carbon::parse($value)->format('d/m/Y');
    }

    public function setDataLaunchAttribute($value){
        $objDate = \DateTime::createFromFormat('d/m/Y', $value);
        $this->attributes['data_launch'] = $objDate->format('Y-m-d');
    }

    //public function getValueAttribute($value){

        //return  number_format($value,2,',','.');

    //}

    public function setValueAttribute($value){

        $valor = str_replace('.', '', $value);
        $valor = str_replace(',', '.', $valor);

        $this->attributes['value'] = $valor;

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
