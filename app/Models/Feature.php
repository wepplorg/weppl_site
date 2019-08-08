<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable =['name','status'];

     public function beneficiaries(){
    	return $this->hasMany(Beneficiary::class,'category_id');
    }
}
