<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;


class Attachment extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function getFilePathAttribute($value)
    {
        return asset(Storage::url($value));
    }
    public function message() : BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
