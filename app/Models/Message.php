<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments() : HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function seen() : HasMany
    {
        return $this->hasMany(Seen::class);
    }

    public function replied() : BelongsTo
    {
        return $this->belongsTo(Message::class, 'reply_id');
    }

    public function markAsSeen()
    {
        $this->seen()->updateOrCreate([
            'user_id' => auth()->id(),

        ]);
    }

    public function getIsReadAttribute($value) : bool
    {
        return $this->seen()->where('user_id', '!=', auth()->id())->exists();
    }

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }
}
