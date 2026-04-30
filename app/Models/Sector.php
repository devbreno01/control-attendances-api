<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = "sectors";

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
