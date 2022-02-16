<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
 
 
class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
    * @param $id
    * @return Model
    */
    public function update(int $id, string $label): ?Model
    {
        return $this->model->update($id, $label);
    }

    /**
    * fetch all records
    */
    public function all(): ?Collection
    {
        return $this->model->all();
    }
}