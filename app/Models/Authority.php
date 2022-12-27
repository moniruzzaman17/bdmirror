<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Authority extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = [
    	'name',
        'email',
        'password',
        'mobile',
        'organization',
        'designation',
        'official_id',
        'nid',
        'working_division',
        'working_district',
        'working_upazila',
        'image',
    ];
}
