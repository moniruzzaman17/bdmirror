<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    
    
    function district() {
        return $this->belongsTo('App\Models\District','district_id','id');
    }

    function complaints() {
        return $this->hasMany('App\Models\Complaint','upazila','id');
    }

    function citizens() {
        return $this->hasMany('App\Models\Citizen','upazila','id');
    }

    function authorities() {
        return $this->hasMany('App\Models\Authority','working_upazila','id');
    }
}
