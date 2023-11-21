<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Contest;

class ContestRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Contest $model)
    {
        $this->model = $model;
    }
}