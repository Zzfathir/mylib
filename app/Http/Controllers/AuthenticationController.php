<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function register(Request $request)
{
$validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8',
]);

      $user = User::create([
              'name' => $validatedData['name'],
                   'email' => $validatedData['email'],
                   'password' => Hash::make($validatedData['password']),
       ]);

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
              'access_token' => $token,
                   'token_type' => 'Bearer',
]);
}

    public function login(Request $request) {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

       // dd($user);

       if(!$user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'account' => ['email yang bener woe'],
        ]);
       }

       return $user->createToken('user login')->plainTextToken;
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'udah logout'
        ]);
    }
}
