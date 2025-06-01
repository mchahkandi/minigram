<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


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

    protected $appends = ['members_count'];


    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'members', 'room_id', 'user_id')->using(Member::class);
    }

    public function messages() : MorphMany
    {
        return $this->morphMany(Message::class, 'messagable');
    }

    public function getMembersCountAttribute()
    {
        return $this->members()->count();
    }

    public function getAvatarAttribute($value)
    {
        return $value ? asset(Storage::url($value)) : null;
    }


}
