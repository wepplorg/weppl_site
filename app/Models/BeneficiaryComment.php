<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryComment extends Model
{
    protected $fillable= ['beneficiary_id','user_id','message'];

    public function users(){
    	 return $this->belongsTo(\App\User::class,'user_id');
    }

    public function beneficiary(){
    	return $this->belongsTo(Beneficiary::class,'beneficiary_id');
    }
}
