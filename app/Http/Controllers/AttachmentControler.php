<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentControler extends Controller
{
    public function download(Attachment $attachment)
    {
        $slice = Str::after($attachment->file_path, 'storage/');

        return Storage::download($slice,$attachment->file_name) ?? abort(404);
    }
}
