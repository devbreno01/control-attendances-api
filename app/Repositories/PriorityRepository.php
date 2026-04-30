<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Priority;


class PriorityRepository extends AbstractRepository{
    protected  static $model = Priority::class;
}

