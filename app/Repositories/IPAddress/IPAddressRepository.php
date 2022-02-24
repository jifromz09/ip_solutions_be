<?php

namespace App\Repositories\IPAddress;

use App\Services\IPAddress\Models\IpAddress;
use App\Interfaces\IPAddressRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Services\IpAddress\DataModels\IpAddressData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class IPAddressRepository extends BaseRepository implements IPAddressRepositoryInterface
{     
    /**
    * IPAddressRepository constructor.
    *
    * @param IpAddress $model
    */
   public function __construct(IpAddress $model)
   {
       parent::__construct($model);
   }

   public function create(array $attributes): IpAddress
   { 
        return $this->model->with('audits')->create((array) IpAddressData::mapIpAddressData($attributes));
   }

   public function findById(int $id): ?IpAddress
   {
        return $this->model->with('audits')->find($id);
   }

   public function auditLogs(int $id) 
   {
        return DB::table('audits')->where('auditable_id', $id)
        ->paginate(10);
   }

   public function all()
   {
        $data =  $this->model->with(['audits','user'])
        ->orderBy('created_at', 'desc')
        ->paginate(15);
        
        return $data;
   }

   public function update(int $id, string $label): ?IpAddress
   {
        $ipAddress = $this->findById($id);
        if($ipAddress)
        {
            $ipAddress->label = $label;
            $ipAddress->save();

            return $ipAddress;
        }
        return null;
   }
}