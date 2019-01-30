<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return api_response('validation error', $errors, 422);
    }

    protected function validation($rules){
        $this->validate($this->request, $rules);
    }
}
