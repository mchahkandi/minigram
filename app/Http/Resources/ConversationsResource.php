<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
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

        if ($this->resource instanceof Chat) {
            if ($this->userOne->id == Auth::id()) {
                $user = $this->userTwo;
            } else {
                $user = $this->userOne;
            }
        }
        return [
            'title' => $user ? $user->name : $this->name,
            'avatar' => $user ? $user->avatar : $this->avatar,
            'route' => $user? $user->id : $this->id,
            'type' => $type,
            'last_message' => $this->messages[0]?->content ?? '',
            'last_update' => $this->messages[0]?->created_at ?? '',
            'unread_messages' => $this->messages()
                ->where('user_id', '!=', Auth::id())
                ->whereDoesntHave('seen', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->count()
        ];
    }
}
