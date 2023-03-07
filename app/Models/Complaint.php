<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'citizen_id',
        'type',
        'title',
        'details',
        'division',
        'district',
        'upazila',
        'position',
        'visibility',
        'is_anonymous',
        'is_published',
        'publish_datetime',
    ];

    function comments() {
        return $this->hasMany('App\Models\Comment','complaint_id','id');
    }
    function ratings() {
        return $this->hasMany('App\Models\Rating','complaint_id','id');
    }
    function medias() {
        return $this->hasMany('App\Models\ComplaintMedias','complaint_id','id');
    }
    
    function citizen() {
        return $this->belongsTo('App\Models\Citizen','citizen_id','id');
    }

    function complaintdivision() {
        return $this->belongsTo('App\Models\Division','division','id');
    }

    function complaintdistrict() {
        return $this->belongsTo('App\Models\District','district','id');
    }

    function complaintupazila() {
        return $this->belongsTo('App\Models\Upazila','upazila','id');
    }

    function complaintstatus() {
        return $this->belongsTo('App\Models\Status','status','id');
    }
}
