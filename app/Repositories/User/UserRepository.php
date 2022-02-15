<?php

namespace App\Repositories\User;

use App\Services\User\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
 
 
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
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['remember_token'] = Str::random(10);
        $attributes['type'] = $attributes['type'] ? $attributes['type']  : 0;
        return $this->model->create($attributes);
   }

   public function findById(int $id): User
   {
        return new User;
   }
}