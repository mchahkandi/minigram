<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'contact_id',
    ];
    public function user() :BelongsTo {
        return $this->belongsTo(User::class,'contact_id');
    }
}
