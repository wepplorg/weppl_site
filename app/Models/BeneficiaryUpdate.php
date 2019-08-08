<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryUpdate extends Model
{
    protected $fillable =['beneficiary_id','ngo_id','description','status'];

    public function beneficiary(){
    	return $this->belongsTo(Beneficiary::class,'beneficiary_id');
    }

    public function users(){
    	return $this->belongsTo(\App\User::class,'ngo_id');
    }
}
