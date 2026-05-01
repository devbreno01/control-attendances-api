<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends BaseModel
{
    protected $table = "attendances";

    protected $fillable = [
        "tenant_id",
        "ticket_id",
        "user_id",
        "status"
    ];

    public function tenants()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user (){
        return $this->belongsTo(User::class);
    }
}
