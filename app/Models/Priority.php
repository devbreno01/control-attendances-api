<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends BaseModel
{
    protected $table = "priorities";

    protected $fillable = [
        "tenant_id" ,
        "name",
        "estimated_time"
    ];


    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }
}
