<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
    'sender_type',
    'receiver_type',
    'sender_id',
    'receiver_id',
    'message',
    'media',
    'is_read'
    ];
}
