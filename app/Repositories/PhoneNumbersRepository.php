<?php

namespace App\Repositories;

use App\Models\PhoneNumber;

class PhoneNumbersRepository extends BaseRepository
{
    /**
     * @param PhoneNumber $model
     */
    public function __construct(PhoneNumber $model)
    {
        $this->model = $model;
    }
}
