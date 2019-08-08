<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens,EntrustUserTrait,HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','slug','password','facebook_id','mobile_no','image','google_id','twitter_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function ngo_profiles(){
        return $this->hasOne(Models\NgoProfile::class,'ngo_id');
    }

    public function beneficiaries(){
        return $this->hasMany(Models\Beneficiary::class,'ngo_id');
    }

    public function comments(){
         return $this->hasMany(Models\BeneficiaryComment::class,'user_id');
    }

    public function payments(){
        return $this->hasMany(Models\Payment::class,'user_id');
    }
   
    public function beneficiary_updates(){
        return $this->hasMany(Models\BeneficiaryUpdate::class,'ngo_id');
    }
}
