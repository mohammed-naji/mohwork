<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // return bcrypt(123);

        if(Auth::attempt($request->all())) {
            $token = $request->user()->createToken('login')->plainTextToken;

            return $this->message(['token' => $token]);
        }

        // $user = User::where('email', $request->email)->first();

        // if($user) {

        //     if(Hash::check($request->password, $user->password)) {

        //         $token = $user->createToken('login')->plainTextToken;

        //         return $this->message(['token' => $token]);

        //     }else {
        //         return $this->message([], 'Password not match', false, 404);
        //     }

        // }else {
        //     return $this->message([], 'No User Found', false, 404);
        // }

    }
}
