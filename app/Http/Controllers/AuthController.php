<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
public function register(StoreUserRequest $request)
{
    $userData = $request->validated();
    $user = User::create($userData);

    $accessToken = $user->createToken('api_token')->plainTextToken;

    $responseData = [
        'data' => $user,
        'access_token' => $accessToken,
        'token_type' => 'Bearer'
    ];

    return response()->json($responseData, 201);
}


public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    $user = User::where('email', $credentials['email'])->first();
    
    return response()->json([
        'access_token' => $user->createToken('api_token')->plainTextToken,
        'token_type' => 'Bearer',
    ]);
}

# Refactored the logout function to improve readability and conform to coding standards.

public function logout()
{
    $user = auth()->user();
    $user->tokens()->delete();
    
    return response()->json(['message' => 'Logout successfully']);
}


}
 