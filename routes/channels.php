<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('chats.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('rooms.{id}', function ($user, $id) {
    return true;
});

