<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgoProfileStatus extends Model
{
    protected $fillable = ['ngo_profile_id','status','comments'];
}
