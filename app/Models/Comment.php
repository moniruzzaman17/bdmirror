<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'citizen_id',
        'authority_id',
        'complaint_id',
        'details',
    ];
    
    function complaints() {
        return $this->belongsTo('App\Models\Complaint','complaint_id','id');
    }
    function citizen() {
        return $this->belongsTo('App\Models\Citizen','citizen_id','id');
    }
}
