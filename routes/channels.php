<?php


Broadcast::channel('messages.{id}',function($user , $id){
    // return true;
    // dd($user,id);
    return $user->id == $id;
});
Broadcast::channel('chat', function ($user) {
    return $user;
});