<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    function send() {
        $admin = Admin::find(1);

        // dd($admin);

        $admin->notify(new NewOrderNotification);
        // Notification::send($users, new NewOrderNotification());

        // $user = User::find(1);
        // $user->notify(new NewOrderNotification);
    }

    function read($id) {

        // dd(Auth::guard('admin')->user());
        Auth::guard('admin')->user()->notifications->find($id)->markAsRead();

        return redirect()->back();
    }
}
