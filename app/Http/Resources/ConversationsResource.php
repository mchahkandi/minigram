<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ConversationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = null;
        $type = Str::lower(Str::afterLast(get_class($this->resource), '\\'));

        if ($this->userOne->id == Auth::id() ) {
            $user = $this->userTwo;
        }else{
            $user = $this->userOne;
        }
        return [
            'title' => $user ? $user->name : '',
            'avatar' => $user ? $user->avatar : '',
            'route' => $user->id,
            'type' => $type,
            'last_message' => $this->messages[0]?->content
        ];
    }
}
