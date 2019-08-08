<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id','beneficiary_id','amount','tickets_count','order_id','payment_type','payment_status','tracking_id','invoice_no','payment_gateway'];

    public function users(){
    	return $this->belongsTo(\App\User::class,'user_id');
    }

    public function beneficiary(){
    	return $this->belongsTo(Beneficiary::class,'beneficiary_id');
    }
}
