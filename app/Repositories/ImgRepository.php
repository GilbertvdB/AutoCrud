<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Img;

class ImgRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Img $model)
    {
        $this->model = $model;
    }
}