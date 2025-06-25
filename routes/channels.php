<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('group.{groupId}', function ($user, $group) {
return $user->groups()->where('group_id', $group->id)->exists();
});
