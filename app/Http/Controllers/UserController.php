<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->middleware('jwt');
    }

    public function profile(){
        return api_response('user data successfully retrieved', $this->request->auth);
    }
}
