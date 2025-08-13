<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectRequest;
use App\Models\User;
use App\Services\AuthTokensService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function connect(ConnectRequest $request, AuthTokensService $authTokensService) {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'error' => "These credentials do not match our records."
            ],400);
        }
        return response()->json([
            'succes' => true,
            'token'  => $authTokensService->generateToken($user),
        ]);
    }
}
