<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request) {
        $this->middleware('jwt');
        $this->request = $request;
    }

    public function profile(){
        return api_response('user data successfully retrieved', $this->request->auth);
    }

}
