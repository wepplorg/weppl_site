<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['city_name','state_id','status'];

    public function states(){
    	return $this->belongsTo(State::class,'state_id');
    }

    public function user(){
    	return $this->hasMany(NgoProfile::class,'city_id');
    }
}
