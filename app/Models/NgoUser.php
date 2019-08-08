<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgoUser extends Model
{
    protected $fillable = ['ngo_profile_id','name','date_of_birth'];

    public function ngo_profile(){
    	return $this->belongsTo(NgoProfile::class,'ngo_profile_id');
    }

    public function beneficiaries(){
    	return $this->hasMany(Beneficiary::class,'ngo_user_id');
    }
}
