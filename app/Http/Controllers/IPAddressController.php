<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IPAddress\Requests\IPAddressRequest;
use App\Interfaces\IPAddressRepositoryInterface;
use App\Services\IpAddress\DataModels\IpAddressData;
use App\Http\Controllers\BaseController as BaseController;

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
        $ipAdd = $this->ipAddressRepository->create($input);
        return $this->sendResponse(IpAddressData::mapIpAddressData($input), 'Ip Address created successfully.');
    }

    public function update($id, IPAddressRequest $request) 
    {
        $input = $request->all();
        $ipAdd = $this->ipAddressRepository->update($id, $input['label']);
        if($ipAdd) 
        {
            return $this->sendResponse(IpAddressData::mapIpAddressData($input), 'Ip Address label updated successfully.');
        }
        return $this->sendError('Server error.', ['error'=>'Ip address not fopund!']);
    }
}
