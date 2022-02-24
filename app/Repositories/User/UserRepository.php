<?php

namespace App\Repositories\User;

use App\Services\User\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Services\User\DataModels\UserData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
 
class UserRepository extends BaseRepository implements UserRepositoryInterface
{     
    /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   public function create(array $attributes): User
   {
        return $this->model->create((array) UserData::mapUserData($attributes));
   }


   public function findById(int $id): User
   {
        return new User;
   }

   public function activityLogs(int $user_id) 
   {
        return DB::table('logs')->where('user_id', $user_id)
        ->paginate(10);
   }
}