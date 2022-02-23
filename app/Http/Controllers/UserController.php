<?php

namespace App\Http\Controllers;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
 
use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Http\Request;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userActvityLogs() 
    {   
        $user = Auth::user();
        $logs = $this->userRepository->activityLogs((int) $user->id);
        return $this->sendResponse($logs, 'User activity logs!');
    }

    public function userAuditTrails() 
    {   
        $user = Auth::user();
        $audits = $user->userAuditTrails();
        return $this->sendResponse($audits, 'User audit trails!');
    }
}
