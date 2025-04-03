<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'username',
        'bio',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function contacts() : HasMany {
        return $this->hasMany(Contact::class);
    }

    public function chatsAsUserOne(): HasMany
    {
        return $this->hasMany(Chat::class, 'user_one_id');
    }

    // User has many chats as user_two
    public function chatsAsUserTwo(): HasMany
    {
        return $this->hasMany(Chat::class, 'user_two_id');
    }

    // User can have many chats in total
    public function chats(): HasMany
    {
        return $this->chatsAsUserOne()->union($this->chatsAsUserTwo());
    }

    public function conversations()
    {
        $chats = Auth::user()->chats()
            ->with(['userOne', 'userTwo','messages' => function ($query) {
                $query->latest()->take(1);
            }],
            )->get();

        $rooms = Auth::user()->rooms()
            ->with(['messages' => function ($query) {
            $query->latest()->take(1);
            }],
            )->get();


        $conversations = $chats->concat($rooms);

        return $conversations;
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class,'members', 'user_id', 'room_id');
    }

    public function createNewChat(int $user_id)
    {
        if (!$user_id) {
            throw new \Exception('User ID must be set');
        }

        if ($user_id == auth()->id()) {
            return back()->with('error', 'You cannot send message to yourself.');
        }

        $this->chats()->create(['user_two_id' => $user_id]);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
