<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Sector;


class SectoreRepository extends AbstractRepository{
    protected  static $model = Sector::class;
}
