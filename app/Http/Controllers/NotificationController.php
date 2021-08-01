<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show(User $user)
    {
        return ['read'=>$user->readNotifications,'unread'=>tap($user->unreadnotifications)->markAsRead()];
    }
}
