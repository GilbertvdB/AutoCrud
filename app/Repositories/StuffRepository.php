<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Stuff;

class StuffRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Stuff $model)
    {
        $this->model = $model;
    }
}