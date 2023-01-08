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
    function complaints() {
        return $this->hasMany('App\Models\Complaint','citizen_id','id');
    }
    
    function comments() {
        return $this->hasMany('App\Models\Comment','citizen_id','id');
    }
}
