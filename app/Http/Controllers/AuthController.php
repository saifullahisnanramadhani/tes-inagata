<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register user baru
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'nullable|in:admin,user'
        ]);

        // kalau role tidak diisi, default user
        if (!isset($validated['role'])) {
            $validated['role'] = 'user';
        }

        $user = User::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'User registered successfully',
            'data'    => $user
        ], 201);
    }

    /**
     * Login dan generate JWT token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'status'  => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Login berhasil',
            'token'   => $token,
            'type'    => 'Bearer'
        ]);
    }

    /**
     * Logout (invalidate token)
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'status'  => true,
            'message' => 'Logout berhasil'
        ]);
    }

    /**
     * Ambil data user login
     */
    public function me()
    {
        return response()->json([
            'status' => true,
            'user'   => auth('api')->user()
        ]);
    }
}