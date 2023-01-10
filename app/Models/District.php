<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    function division() {
        return $this->belongsTo('App\Models\District','division_id','id');
    }
    
    function upazilas() {
        return $this->hasMany('App\Models\Upazila','district_id','id');
    }
    
    function complaints() {
        return $this->hasMany('App\Models\Complaint','district','id');
    }

    function citizens() {
        return $this->hasMany('App\Models\Citizen','district','id');
    }

    function authorities() {
        return $this->hasMany('App\Models\Authority','working_district','id');
    }
}
