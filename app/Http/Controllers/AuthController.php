<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $rules = [
        'login' => [
            'username'  => 'required',
            'password'  => 'required'
        ]
    ];

    protected function jwt(User $user) {
        $payload = [
            'iss' => "jwt",             // Issuer of the token
            'sub' => $user->uuid,       // Subject of the token
            'iat' => time(),            // Time when JWT was issued.
            'exp' => time() + 60 * 60   // Expiration time
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function login() {
        $this->validation($this->rules['login']);

        $user = User::where('username', $this->request->input('username'))->first();
        if (!$user) {
            return api_response('user does not exist', null, 400);
        }

        if (!Hash::check($this->request->input('password'), $user->password)) {
            return api_response('username or password is invalid', null, 400);
        }

        $response = [
            'token' => $this->jwt($user)
        ];

        return api_response('login successfull', $response);
    }
}
