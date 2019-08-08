<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgoDocument extends Model
{
    protected $fillable = ['ngo_profile_id','registration_document','pan_number','reg_12a_doc','reg_80g_doc','audi_statement'];

    public function ngo_profile(){
    	return $this->belongsTo(NgoProfile::class,'ngo_profile_id');
    }
}
