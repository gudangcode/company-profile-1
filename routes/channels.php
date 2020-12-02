<?php

/*
|--------------------------------------------------------------------------
| Author   : Nyoman Adi Yudana
| github   : https://github.com/devadiyudana
| website  : https://adiyudana.com
| phone    : +62 813 7784 3910
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
