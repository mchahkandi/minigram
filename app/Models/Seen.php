<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    protected $fillable = [
        'user_id',
        'message_id',
        'seen_at'
    ];
}
