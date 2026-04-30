<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends BaseModel
{
    protected $table = "sectors";

    protected $fillable = [
        "name",
        "tenant_id"
    ];

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
