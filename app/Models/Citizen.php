<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Citizen extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'mobile',
    	'image',
        'division',
        'district',
        'upazila',
    ];

    public static function updateLastLoginDate() {
        if (Auth::guard('citizen')->check()) {
            $user = Citizen::where('mobile', Auth::guard('citizen')->user()->mobile)->first();
            $user->touch();
        }
    }
    function complaints() {
        return $this->hasMany('App\Models\Complaint','citizen_id','id');
    }
    
    function comments() {
        return $this->hasMany('App\Models\Comment','citizen_id','id');
    }
    
    function ratings() {
        return $this->hasMany('App\Models\Rating','citizen_id','id');
    }

    function citizenDivision() {
        return $this->belongsTo('App\Models\Division','division','id');
    }

    function citizenDistrict() {
        return $this->belongsTo('App\Models\District','district','id');
    }

    function citizenUpazila() {
        return $this->belongsTo('App\Models\Upazila','upazila','id');
    }
}
