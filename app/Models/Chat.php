<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chat extends Model
{
    protected $fillable = [
        'user_one_id', 'user_two_id'
    ];
    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    // Chat belongs to user_two
    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function messages() : MorphMany
    {
        return $this->morphMany(Message::class, 'messagable');
    }

    public function scopeFindChat($query, int $userOneId, int $userTwoId)
    {
        return $query->where(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userOneId)
                ->where('user_two_id', $userTwoId);
        })->orWhere(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userTwoId)
                ->where('user_two_id', $userOneId);
        });
    }

    public static function createIfNotExist(int $userOneId, int $userTwoId): Chat
    {
        $chat = self::where(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userOneId)
                ->where('user_two_id', $userTwoId);
        })->orWhere(function ($query) use ($userOneId, $userTwoId) {
            $query->where('user_one_id', $userTwoId)
                ->where('user_two_id', $userOneId);
        })->first();

        if (!$chat) {
            $chat = self::create([
                'user_one_id' => $userOneId,
                'user_two_id' => $userTwoId,
            ]);
        }

        return $chat;
    }
}
