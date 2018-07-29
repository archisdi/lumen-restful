<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt",   // Issuer of the token
            'sub' => $user->id,     // Subject of the token
            'iat' => time(),        // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function login() {
        $this->validate($this->request, [
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('username', $this->request->input('username'))->first();
        if (!$user) {
            return response()->json([
                'error' => 'user does not exist'
            ], 400);
        }

        if (!Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'error' => 'username or password is invalid'
            ], 400);
        }

        return response()->json([
            'token' => $this->jwt($user)
        ], 200);
    }
}
