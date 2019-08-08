<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryMedia extends Model
{
    protected $fillable = ['beneficiary_id','image'];

    public function beneficiary(){
    	return $this->belongsTo(Beneficiary::class,'beneficiary_id');
    }
}
