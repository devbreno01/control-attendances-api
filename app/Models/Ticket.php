<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends BaseModel
{
    protected $table = "tickets";

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
