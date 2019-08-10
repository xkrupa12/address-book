<?php

namespace App\Repositories;

use App\Models\Address;

class AddressesRepository extends BaseRepository
{
    /**
     * @param Address $model
     */
    public function __construct(Address $model)
    {
        $this->model = $model;
    }
}
