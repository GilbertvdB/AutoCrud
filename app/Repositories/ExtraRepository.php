<?php

namespace App\Repositories;

use App\Models\Extra;
use App\Models\NameModel;

class ExtraRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Extra $model)
    {
        $this->model = $model;
    }
}
