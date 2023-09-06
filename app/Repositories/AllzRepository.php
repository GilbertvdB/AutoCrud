<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Allz;

class AllzRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Allz $model)
    {
        $this->model = $model;
    }
}