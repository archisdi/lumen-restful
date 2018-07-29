<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(Request $request) {
        $this->middleware('jwt');
    }

    public function profile(Request $request){
        return api_response('user data successfully retrieved', $request->auth);
    }

}
