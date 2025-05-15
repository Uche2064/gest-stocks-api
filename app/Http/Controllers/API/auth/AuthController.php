<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginUserFormRequest;
use App\Http\Requests\auth\RegisterUserFormRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserFormRequest $request) {
        $requestData = $request->validated();

        $user = User::create([
            'name' => $requestData['name'],
            'username' => $requestData['username'],
            'bio' => $requestData['bio'],
            'email' => $requestData['email'],
            'password' => $requestData['password'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $responseData = [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return response()->json($responseData, 201);
    }

    public function login(LoginUserFormRequest $request) {
        $requestData = $request->validated();

        $user = User::where('email', $requestData['email'])->first();

        if(!$user || !Hash::check($requestData['password'], $user->password)) {
            throw new HttpResponseException(
                response()->json([
                'error'=>['Les informations fournies sont incorrectes']
            ], 422));
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $responseData = [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'connexion réussie'    
        ];

        return response()->json($responseData, 200);
    }
}
