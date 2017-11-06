<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BillPay extends Model
{
    protected $fillable = ['name','value','data_launch','data_pay','observacoes','status','anexo','user_id','category_cost_id'];

    public function getDataLaunchAttribute($value){
        return  Carbon::parse($value)->format('d/m/Y');
    }

    public function setDataLaunchAttribute($value){
        $objDate = \DateTime::createFromFormat('d/m/Y', $value);
        $this->attributes['data_launch'] = $objDate->format('Y-m-d');
    }

    public function setDataPayAttribute($value){
        $objDate = \DateTime::createFromFormat('d/m/Y', $value);
        $this->attributes['data_pay'] = $objDate->format('Y-m-d');
    }

    //public function getValueAttribute($value){

    //    return  number_format($value,2,',','.');
    //}

    public function setValueAttribute($value){

        $valor = str_replace('.', '', $value);
        $valor = str_replace(',', '.', $valor);

        $this->attributes['value'] = $valor;

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categoryCosts(){
        return $this->belongsTo(CategoryCost::class, 'category_cost_id');
    }
}
