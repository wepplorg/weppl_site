<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable =['state_name','status'];

    public function cities(){
    	return $this->hasMany(City::class,'state_id');
    }

    public function user(){
    	return $this->hasMany(NgoProfile::class,'city_id');
    }
}
