<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $conditions = [])
    {
        if (!empty($conditions)) {
            return $this->model->where($conditions)->get();
        }
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $object = $this->model->findOrFail($id);
        $object->update($attributes);
        return $object;
    }

    public function delete($id)
    {
        return Model::destroy($id);
    }
}
