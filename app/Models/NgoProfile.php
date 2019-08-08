<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgoProfile extends Model
{
    protected $fillable = ['ngo_id','state_id','city_id','contact_person_name','contact_person_designation','bank_name','account_number','account_type','ifsc_code','logo','address','description','pincode','document','verify','terms','status','twitter_share','facebook_share','website_url','decalration','date_incorporation','addtional_document','document_agree','document_terms'];

    public function users(){
    	return $this->belongsTo(\App\User::class,'ngo_id');
    }

     public function states(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function cities(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function documents(){
        return $this->hasOne(NgoDocument::class,'ngo_profile_id');
    }
    public function ngo_users(){
        return $this->hasMany(NgoUser::class,'ngo_profile_id');
    }
}
