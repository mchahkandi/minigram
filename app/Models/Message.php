<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Message extends Model
{
    protected $fillable = [
        'messagable_id',
        'messagable_type',
        'user_id',
        'content',
        'reply_id',
        'is_read',
    ];
    public function messagable(): MorphTo
    {
        return $this->morphTo();
    }
}
