<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['meta' => ['success' => false, 'errors' => ['Password incorrect for: ' . $request->username]]], 401);
        }

        return response()->json(['meta' => ['success' => true, 'errors' => []], 'data' => ['token' => $token, 'minutes_to_expire' => auth()->factory()->getTTL() * 60]]);
    }
}