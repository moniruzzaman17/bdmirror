<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    function division() {
        return $this->belongsTo('App\Models\District','district_id','id');
    }
    
    function upazilas() {
        return $this->hasMany('App\Models\Upazila','district_id','id');
    }
}
