<?php

namespace App\Repositories;

use App\Models\Email;

class EmailsRepository extends BaseRepository
{
    /**
     * @param Email $model
     */
    public function __construct(Email $model)
    {
        $this->model = $model;
    }
}
