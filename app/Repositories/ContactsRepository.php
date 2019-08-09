<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ContactsRepository
{
    /**
     * @var Contact
     */
    private $model;

    /**
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return Contact|Model
     */
    public function findOrFail(int $id): Contact
    {
        return $this->model->query()->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->model->query()->get();
    }

    /**
     * @param array $attributes
     * @return Contact
     */
    public function create(array $attributes): Contact
    {
        dd('todo!');

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
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->query()->delete($id);
    }
}
