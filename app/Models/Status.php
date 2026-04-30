<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "statuses";

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
