<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Test;

class TestRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Test $model)
    {
        $this->model = $model;
    }
}
