<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    function complaints() {
        return $this->hasMany('App\Models\Complaint','status','id');
    }
}
