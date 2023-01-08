<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintMedias extends Model
{
    use HasFactory;
    protected $fillable = [
        'complaint_id',
        'type',
        'medias',
        'additional_medias',
    ];
}
