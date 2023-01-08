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
}
