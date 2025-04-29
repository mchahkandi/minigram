<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function attachments() : HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function search($query)
    {
        return $this->where('content', 'LIKE', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
