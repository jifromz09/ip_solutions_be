<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IPAddress\Requests\IPAddressRequest;
use App\Interfaces\IPAddressRepositoryInterface;
use App\Services\IpAddress\DataModels\IpAddressData;
use App\Services\IpAddress\Requests\IPAddressUpdateRequest;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Services\IPAddress\Models\IpAddress;

class IPAddressController extends BaseController
{
    private $ipAddressRepository;

    public function __construct(IPAddressRepositoryInterface $ipAddressRepository)
    {
        $this->ipAddressRepository = $ipAddressRepository;
    }

    /**
     * IP Address api
     *
     * @return \Illuminate\Http\Response
     */

    public function create (IPAddressRequest $request) 
    {
        $input = $request->all();
        $user = $this->guard()->user();
        $data = new IpAddressData(
            label: $input['label'],
            ip_address: $input['ip_address'],
            user_id: $user->id
        );
        $ipAdd = $this->ipAddressRepository->create((array)$data);
        if($ipAdd) 
        {
            return $this->sendResponse($ipAdd, 'IP Address created successfully.');
        }
        return $this->sendError('Server error.', ['error'=>'Error on saving']);
    }

    public function update($id, IPAddressUpdateRequest $request) 
    {
        $input = $request->all();
        $ipAdd = $this->ipAddressRepository->update($id, $input['label']);
        if($ipAdd) 
        {
            return $this->sendResponse($ipAdd, 'IP Address label updated successfully.');
        }
        return $this->sendError('Server error.', ['error'=>'Ip address not found!']);
    }

    public function findById(int $id) 
    {
        $ipAdd = $this->ipAddressRepository->findById($id);
        if($ipAdd) 
        {
            return $this->sendResponse($ipAdd, 'IP address exist.');
        }
        return $this->sendError('Server error.', ['error'=>'Ip address not found!']);
    }

    public function ipAuditTrails(int $id)
    {
        $logs = $this->ipAddressRepository->auditLogs($id);
        if($logs) 
        {
            return $this->sendResponse($logs, 'IP audit logs.');
        }
        return $this->sendError('Server error.', ['error'=>'Ip address not found!']);
    }

    public function getAll()
    {
        $ipAdds = $this->ipAddressRepository->all();
        return $this->sendResponse($ipAdds, 'IP address list.');
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
