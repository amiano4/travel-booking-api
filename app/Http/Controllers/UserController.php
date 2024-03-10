<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Create new user api
     */
    public function createUser(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'email' => 'email|nullable',
            'website' => 'string|nullable',
            'type' => 'nullable',
            'username' => 'string|required|min:6|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);

        if($user = User::create([
            'name' => $request->name,
            'website' => $request->website,
            'user_type' => $request->type,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'message' => 'A new user has been successfully created!',
                'user_data' => [
                    'name' => $user->name,
                    'username' => $user->username,
                ]
            ]);
        }

        return response()->json('Error.', 500);
    }
}
