<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Function to register a new user
    public function register(Request $request)
    {
        // Validate The Request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|min:5|unique:users',
            'email' => 'required|string|email|max:150|unique:users',
            'password' => 'required|string|min:8',
            'c_password' => 'required|same:password',
            'level' => 'required|string|in:mitra,investor',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create The User
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'level' => $request->level,
            'is_active' => 1,
        ]);

        // Return Response
        if (!$user) return response()->json(['message' => 'User failed to register']);
        return response()->json(['message' => 'User successfully registered', 'user' => $user]);
    }

    // Function to login a user
    public function login(Request $request)
    {
        // Validate The Request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Return Validation Error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get The Credentials
        $credentials = request(['username', 'password']);

        // Check The Credentials
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Return The Token
        return $this->respondWithToken($token);
    }

    // Function to get the authenticated user
    public function me()
    {
        $user = JWTAuth::user();
        if (!$user) return response()->json(['message' => 'Unauthorized'], 401);
        return response()->json($user);
    }

    // Function to logout the authenticated user
    public function logout()
    {
        auth('api')->logout(true);
        // auth('api')->invalidate(true);
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 600
        ]);
    }
}
