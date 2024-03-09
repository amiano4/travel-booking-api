<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        $login = $request->only('username', 'password');

        if(Auth::attempt($login)) {
            $token = $request->user()->createToken('auth')->plainTextToken;
            $user = Auth::user();
            return  $this->sendAuthResponse($user, $token);
        }

        return response()->json('Error.', 500);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logout successfully!', 200);
    }

    public function refreshAuth(Request $request) {
        // revoke last token
        $request->user()->currentAccessToken()->delete();

        // create new token
        $user = Auth::user();
        $token = $request->user()->createToken('auth')->plainTextToken;

        return $this->sendAuthResponse($user, $token);
    }

    private function sendAuthResponse(User $user, $token) {
        return response()->json([
            'name' => $user->name,
            'username' => $user->username,
        ], 200, [
            'User-Token' => $token,
            'User-Token-Status' => 'renewed',
        ]);
    }
}