<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(Request $request) {
        $this->middleware('jwt');
        parent::__construct($request);
    }

    public function profile(){
        return api_response('user data successfully retrieved', $this->request->auth);
    }

}
