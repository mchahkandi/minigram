<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'link',
        'avatar',
        'type',
        'owner_id',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'members', 'room_id', 'user_id');
    }

    public function messages() : MorphMany
    {
        return $this->morphMany(Message::class, 'messagable');
    }
}
