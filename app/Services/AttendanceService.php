<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\AttendanceEvents;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use Exception;

class AttendanceService
{
    private int $tenant_id;

    public function __construct()
    {
        $this->tenant_id = Auth::user()->tenant_id;
    }
    //start chamado
    public function start(int $ticketId): Attendance
    {


        return DB::transaction(function () use ($ticketId) {

            $attendantIsBusy = Attendance::where('user_id', Auth::id())
                             ->where('status', 'in_progress')
                             ->exists();

            if ($attendantIsBusy) {
                throw new Exception('Você já possui um atendimento em andamento.');
            }

            $ticket = Ticket::with('status')->findOrFail($ticketId);

            // Regra: não pode iniciar se finalizado ou cancelado
            if (in_array($ticket->status->name, ['Finalizado', 'Cancelado'])) {
                throw new Exception('Chamado não pode ser iniciado.');
            }

            // Regra: não pode ter atendimento ativo
            //!=
            $hasOpen = $ticket->attendances()
                ->where('status', '!=', 'finished')
                ->exists();

            if ($hasOpen) {
                throw new Exception('Já existe atendimento em andamento.');
            }


            $user_id = Auth::user()->id;
            $attendance = Attendance::create([
                'tenant_id' =>$this->tenant_id,
                'user_id' => $user_id,
                'ticket_id' => $ticket->id,
                'started_at' => now(),
                'status' => 'in_progress',
            ]);


            $this->createEvent($attendance->id, 'start');

            return $attendance;
        });
    }

    //pause chamado
    public function pause(int $attendanceId): Attendance
    {
        return DB::transaction(function () use ($attendanceId) {

            $attendance = Attendance::findOrFail($attendanceId);


            if ($attendance->status !== 'in_progress') {
                throw new Exception('Atendimento não pode ser pausado.');
            }

            if ($attendance->ended_at) {
                throw new Exception('Atendimento já finalizado.');
            }

            $attendance->update([
                'status' => 'paused',
            ]);

            $this->createEvent($attendance->id, 'pause');

            return $attendance;
        });
    }

    //resume chamado(despausa)
    public function resume(int $attendanceId): Attendance
    {
        return DB::transaction(function () use ($attendanceId) {

            $attendance = Attendance::findOrFail($attendanceId);

            if ($attendance->status !== 'paused') {
                throw new Exception('Atendimento não pode ser retomado.');
            }

            if ($attendance->finished_at) {
                throw new Exception('Atendimento já finalizado.');
            }

            $attendance->update([
                'status' => 'in_progress',
            ]);

            $this->createEvent($attendance->id, 'resume');

            return $attendance;
        });
    }

   //finish chamado
    public function finish(int $attendanceId, string $solution): Attendance
    {
        return DB::transaction(function () use ($attendanceId, $solution) {

            $attendance = Attendance::with('ticket.status')->findOrFail($attendanceId);

            if (!in_array($attendance->status, ['in_progress', 'paused'])) {
                throw new Exception('Atendimento não pode ser finalizado.');
            }

            if(trim($solution) === ''){
                throw new Exception("Para finalizar um chamado é preciso que disponibilize a solução do mesmo");
            }

            $attendance->update([
                'status' => 'finished',
                'ended_at' => now(),
                'solution' => $solution,
            ]);


            $attendance->ticket->update([
                'status_id' => $this->getStatusId('Finalizado')
            ]);

            $this->createEvent($attendance->id, 'finish');

            return $attendance;
        });
    }

    //register log
    private function createEvent(int $attendanceId, string $type): void
    {
        AttendanceEvents::create([
            'tenant_id' => $this->tenant_id,
            'attendance_id' => $attendanceId,
            'type' => $type,
            'occurred_at' => now(),
        ]);
    }


    private function getStatusId(string $statusName): int
    {

        return Status::where('name', $statusName)->value('id');
    }
}
