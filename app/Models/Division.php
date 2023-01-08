<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    
    function districts() {
        return $this->hasMany('App\Models\District','division_id','id');
    }
    
    function complaints() {
        return $this->hasMany('App\Models\Complaint','division','id');
    }
}
