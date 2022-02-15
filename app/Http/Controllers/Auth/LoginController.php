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
use Carbon\Carbon;
use App\Services\User\DataModels\AuthData;
use App\Services\User\DataModels\CredentialData;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login (Request $request)
    {
        if($this->guard()->attempt((array)CredentialData::mapCredentialData($request)))
        { 
            $user = $this->guard()->user();
            $tokenResult = auth('web')->user()->createToken('IP Solutions');
            
            return $this->sendResponse(AuthData::mapAuthData($user, $tokenResult), 'User login successfully.');
        } 
        else
        {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout ()
    {
        if (Auth::check()) 
        {
            Auth::user()->token()->revoke();
            return $this->sendResponse([], 'You have been successfully logged out!');
        } 
        else 
        {
            return $this->sendResponse([], 'No Authenticated User.');
        }
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

    protected function guard()
    {
        return Auth::guard();
    }
}
