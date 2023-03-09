<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
    protected $fillable = [
        'citizen_id',
        'email',
        'mobile',
        'relation',
    ];

    function citizen() {
        return $this->belongsTo('App\Models\Citizen','citizen_id','id');
    }
}
