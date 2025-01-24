<?php
use Illuminate\Support\Facades\Broadcast;

/*
|---------------------------------------------------------------------------
| Broadcast Channels
|---------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// For a user-specific channel
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// For a group chat channel with multiple guards
Broadcast::channel('groupChat.{alertId}', function ($user, $alertId) {
    return true; // You can customize this check depending on your logic
}, ['guards' => ['web', 'admin', 'api']]);
