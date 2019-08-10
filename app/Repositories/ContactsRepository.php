<?php

namespace App\Repositories;

use App\Models\Contact;

/**
 * @method Contact create(array $attributes)
 */
class ContactsRepository extends BaseRepository
{
    /**
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }
}
