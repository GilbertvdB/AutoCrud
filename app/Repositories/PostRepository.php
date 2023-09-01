<?php

namespace App\Repositories;

use App\Models\NameModel;
use App\Models\Post;

class PostRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     *
     * @param  NameModel  $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}