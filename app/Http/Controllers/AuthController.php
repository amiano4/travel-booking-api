<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    static $abPanelUser = 'client';
    static $abAdminUser = 'super';

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login = $request->only('username', 'password');

        if(Auth::attempt($login)) {
            $ability = explode(',', self::$abAdminUser);
            if(Auth::user()->user_type == 'client') {
                $ability = explode(',', self::$abPanelUser);
            }

            $token = $request->user()->createToken('auth', $ability)->plainTextToken;
            $user = Auth::user();
            return  $this->sendAuthResponse($user, $token);
        }

        return response()->json('Incorrect username/password. Please try again.', 422);
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
        $ability = explode(',', self::$abAdminUser);
        if(Auth::user()->user_type == 'client') {
            $ability = explode(',', self::$abPanelUser);
        }

        $token = $request->user()->createToken('auth', $ability)->plainTextToken;

        return $this->sendAuthResponse($user, $token);
    }

    private function sendAuthResponse(User $user, $token) {
        return response()->json([
            'name' => $user->name,
            'username' => $user->username,
            'type' => isset($user->user_type) && !empty($user->user_type) ? $user->user_type : null,
        ], 200, [
            'User-Token' => $token,
            'User-Token-Status' => 'renewed',
        ]);
    }
}