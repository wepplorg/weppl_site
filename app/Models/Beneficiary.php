<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Carbon\Carbon;
class Beneficiary extends Model
{
	use HasSlug;
    protected $fillable=['ngo_id','category_id','feature_id','ngo_user_id','slug','age','title','summary','description','location','start_date','end_date','goal_amount','document','status','main_display_image'];

    public function users(){
    	return $this->belongsTo(\App\User::class,'ngo_id');
    }

    public function ngo_users(){
    	return $this->belongsTo(NgoUser::class,'ngo_user_id');
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function images(){
    	return $this->hasOne(BeneficiaryMedia::class,'beneficiary_id');
    } 

    public function comments(){
         return $this->hasMany(BeneficiaryComment::class,'beneficiary_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'beneficiary_id')->where('payment_status','=',"Success");
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function feature(){
        return $this->belongsTo(Feature::class,'feature_id');
    }

    public function updates(){
        return $this->hasMany(BeneficiaryUpdate::class,'beneficiary_id');
    }

}
