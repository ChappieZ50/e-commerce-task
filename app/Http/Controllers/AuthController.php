<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthRequest $request)
    {
        $token = auth('api')->attempt($request->validated());

        if (!$token) {
            return response()->json([
                'message' => 'Your email or password is invalid',
            ], Response::HTTP_NOT_FOUND);
        }

        $user = auth()->user();
        return response()->json([
            'user'  => [
                'name'  => $user->name,
                'email' => $user->email
            ],
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $token = auth()->login($user);
        return response()->json([
            'user'  => [
                'name'  => $user->name,
                'email' => $user->email
            ],
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json();
    }
}
