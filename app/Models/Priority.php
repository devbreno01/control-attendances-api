<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends BaseModel
{
    protected $table = "priorities";

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
