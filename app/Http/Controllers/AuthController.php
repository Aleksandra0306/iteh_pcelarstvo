<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'id' => $user->id,
            'token' => $token,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role, // Assuming 'role' is a field in the User model
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }


    public function register(Request $request)
    {
        $validatedUser = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pcelar',
        ]);
        $user = User::create($validatedUser);
        return response()->json([
            'message' => 'Account created',
            'user' => new UserResource($user)
        ]);
    }
}
