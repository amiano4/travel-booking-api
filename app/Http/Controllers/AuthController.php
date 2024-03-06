<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function createUser(Request $request) {
        // return response()->json('Error.', 500);
        $isValid = $request->validate([
            'name' => 'string|required',
            'email' => 'email|nullable',
            'username' => 'string|required|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);


        if($isValid)
        if($user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'message' => 'A new user has been successfully created!',
                'user_data' => $user
            ]);
        }

        return response()->json('Error.', 500);
    }

    public function test() {
        return response()->json('Successfully connected.');
    }
}