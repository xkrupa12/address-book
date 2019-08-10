<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param int $id
     * @param array $with
     * @return Contact|Model
     */
    public function findOrFail(int $id, array $with): Contact
    {
        return $this->model->with($with)->findOrFail($id);
    }

    /**
     * @param array $where
     * @param array $with
     * @param array $cols
     * @return Model|null
     */
    public function firstOrFail(array $where = [], array $with = [], array $cols = ['*']): ?Model
    {
        return $this->model->with($with)->where($where)->first($cols);
    }

    /**
     * @param array $where
     * @param array $with
     * @param array $cols
     * @return Collection
     */
    public function get(array $where = [], array $with = [], array $cols = ['*']): Collection
    {
        return $this->model->with($with)->where($where)->get($cols);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->query()->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return int
     */
    public function update(int $id, array $attributes): int
    {
        return $this->model->query()->where('id', $id)->update($attributes);
    }

    /**
     * @param array $where
     * @param array $changes
     * @return int
     */
    public function change(array $where, array $changes): int
    {
        return $this->model->query()->where($where)->update($changes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->query()->where('id', $id)->delete();
    }
}
