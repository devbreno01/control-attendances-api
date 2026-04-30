<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends BaseModel
{
    protected $table = "statuses";
    protected $fillable = ["name"];
}
