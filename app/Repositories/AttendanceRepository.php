<?php

namespace App\Repositories;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class AttendanceRepository extends AbstractRepository {
    protected  static $model = Attendance::class;

    public function listAttendances(int $tenant_id){
        $sql = "
            SELECT
                tic.title as ticket_title,
                tic.description as ticket_description,
                att.status as live_status,
                sec.name as sector,
                pri.name as priority,
                (att.ended_at - att.started_at) as total_attendance_time
            FROM attendances att
            INNER JOIN tickets tic
                ON att.ticket_id = tic.id
            INNER JOIN sectors sec
                ON tic.sector_id = sec.id
            INNER JOIN priorities pri
                ON  tic.priority_id = pri.id
            INNER JOIN statuses sta
                ON tic.status_id = sta.id
            WHERE att.tenant_id = ?

        ";


        $result = DB::select($sql, [$tenant_id]);
        return collect($result);
    }


     public function listAttendancesById(int $tenant_id, int $id){
        $sql = '
            SELECT
                tic.title as ticket_title,
                tic.description as ticket_description,
                att.status as live_status,
                sec.name as sector,
                pri.name as priority,
                (att.ended_at - att.started_at) as total_attendance_time
            FROM attendances att
            INNER JOIN tickets tic
                ON att.ticket_id = tic.id
            INNER JOIN sectors sec
                ON tic.sector_id = sec.id
            INNER JOIN priorities pri
                ON  tic.priority_id = pri.id
            INNER JOIN statuses sta
                ON tic.status_id = sta.id
            WHERE att.tenant_id = ?
            AND att.id = ?
        ';

        $result = DB::select($sql, [$tenant_id, $id]);
        return collect($result);

    }


    public function getAvgTime(){
        return $avgTime = DB::table('attendances')
                ->whereNotNull('ended_at')
                ->selectRaw('AVG(ended_at - started_at) as avg_time')
                ->value('avg_time');
    }
}
