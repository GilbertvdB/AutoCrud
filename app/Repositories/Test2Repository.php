<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Test2;

class Test2Repository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Test2 $model)
    {
        $this->model = $model;
    }
}