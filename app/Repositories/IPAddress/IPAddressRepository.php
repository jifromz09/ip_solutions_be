<?php

namespace App\Repositories\IPAddress;

use App\Services\IPAddress\Models\IPAddress;
use App\Interfaces\IPAddressRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Services\IpAddress\DataModels\IpAddressData;
use Illuminate\Database\Eloquent\Collection;

class IPAddressRepository extends BaseRepository implements IPAddressRepositoryInterface
{     
    /**
    * IPAddressRepository constructor.
    *
    * @param IPAddress $model
    */
   public function __construct(IPAddress $model)
   {
       parent::__construct($model);
   }

   public function create(array $attributes): IPAddress
   { 
        return $this->model->with('audits')->create((array) IpAddressData::mapIpAddressData($attributes));
   }

   public function findById(int $id): ?IPAddress
   {
        return $this->model->with('audits')->find($id);
   }

   public function all(): Collection
   {
        return $this->model->with('audits')->all();
   }

   public function update(int $id, string $label): ?IPAddress
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