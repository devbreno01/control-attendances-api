<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = "priorities";

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
