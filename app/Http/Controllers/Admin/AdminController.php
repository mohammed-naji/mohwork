<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function dashboard($lang = 'en') {
        // App::setLocale($lang);
        return view('admin.dashboard');
    }

    function profile() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    function profile_update(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        dd($request->all());

        $img = $request->file('image')->store('images', 'files');

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();
        $admin->update([
            'name' => $request->name,
            'image' => $img
        ]);

        return redirect()->back();
    }

    function profile_image(Request $request) {
        // return $request->all();

        $img = $request->file('file')->store('images', 'files');

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();
        $admin->update([
            'image' => $img
        ]);

        return response()->json([
            "success" => true,
            "url"   => asset($img)
        ]);
    }

    function profile_password() {
        return view('admin.profile_password');
    }

    function profile_password_update(Request $request) {
        // dd($request->all());
        $request->validate([
            'password' => 'min:6|confirmed'
        ]);

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        if(!Hash::check($request->old_password, $admin->password)) {
            return redirect()
            ->back()
            ->with('msg', 'Old password does not match')
            ->with('type', 'danger');;
        }

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
        ->back()
        ->with('msg', 'Password updated')
        ->with('type', 'success');
    }
}

//
