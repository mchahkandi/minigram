<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Member extends Pivot
{
    protected $fillable = [
        'room_id',
        'user_id',
    ];
}
