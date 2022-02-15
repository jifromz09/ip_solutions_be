<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Ip;
use Validator;
use App\Http\Resources\Ip as IpResource;
   
class IpController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ips = Ip::all();
    
        return $this->sendResponse(IpResource::collection($ips), 'Ip retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'ip' => 'required',
            'comment' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $ip = Ip::create($input);
   
        return $this->sendResponse(new IpResource($ip), 'Ip created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ip = Ip::find($id);
  
        if (is_null($ip)) {
            return $this->sendError('Ip not found.');
        }
   
        return $this->sendResponse(new IpResource($ip), 'Ip retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ip $ip)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'ip' => 'required',
            'comment' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        // $ip->name = $input['ip'];
        $ip->comment = $input['comment'];
        $ip->save();
   
        return $this->sendResponse(new IpResource($ip), 'Product updated successfully.');
    }
}