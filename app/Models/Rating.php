<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'citizen_id',
        'complaint_id',
        'like'
    ];
    
    function complaint() {
        return $this->belongsTo('App\Models\Rating','complaint_id','id');
    }
    
    function citizen() {
        return $this->belongsTo('App\Models\Citizen','citizen_id','id');
    }
}
