<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Services\User\Requests\UserRegistrationRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Services\User\DataModels\AuthData;
 

class ApiAuthController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register (UserRegistrationRequest $request) 
    {   
        $input = $request->all();
        $user = $this->userRepository->create($input);
        $tokenResult = $user->createToken('Laravel Password Grant Client');
        return $this->sendResponse(AuthData::mapAuthData($user, $tokenResult), 'User register successfully.');
    }
}
