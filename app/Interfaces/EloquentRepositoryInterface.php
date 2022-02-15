<?php

namespace App\Interfaces;


use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function findById(int $id): ?Model;

    /**
    * @param $id
    * @return Model
    * @param array $attributes
    */
    public function update(int $id, array $attributes): ?Model;

     /**
    * @param $id
    * @return Model
    * @param array $attributes
    */

     /**
    * @param $id
    * @return Model
    * @param array $attributes
    */
    public function all(): ?Model;
}