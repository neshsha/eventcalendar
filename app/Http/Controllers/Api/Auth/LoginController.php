<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Redirect;
use Response;
use Auth;
use Validator;
use App\User;

 

class LoginController extends Controller
{

	// public function __construct() {
 //        $this->middleware('auth:api', ['except' => ['login',]]);
 //    }

    public function login(Request $request) {

    	$creds = $request->only(['username','password']);

    	if (! $token = auth()->attempt($creds)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

      // return response()->json(['token' => $token]);

        return Response::json(compact('token'));

    }


}
