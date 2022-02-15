<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
 
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login (Request $request) {
        if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password]))
        { 
            $user = Auth::user(); 
            $token = auth('web')->user()->createToken('MyApp')->accessToken;
            $success['token'] =  $token['token'];
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else
        {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return $this->sendResponse($success, 'You have been successfully logged out!');
    }

  
      /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
