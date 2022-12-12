<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintMedias extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'medias',
        'additional_medias',
    ];
}
