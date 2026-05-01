<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceEvents extends BaseModel
{
    protected $table ="attendance_events";

    protected $fillable = [
        "tenant_id",
        "attendance_id",
        "type",
        "occurred_at"
    ];

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }


}
