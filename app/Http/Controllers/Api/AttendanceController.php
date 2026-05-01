<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Http\Requests\FinishAttendanceRequest;


class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $service)
    {
        $this->attendanceService = $service;
    }
    public function start(int $ticketId){
        try{
            $start = $this->attendanceService->start($ticketId);
            return response()->json(["message" => "Atendimento iniciado",
                                    "data" => $start]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    public function pause(int $attendanceId){
        try{
            $pause = $this->attendanceService->pause($attendanceId);
            return response()->json(["message" => "Atendimento pausado",
                                    "data" => $pause]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    public function resume(int $attendanceId){
        try{
            $resume = $this->attendanceService->resume($attendanceId);
            return response()->json(["message" => "Atendimento aberto novamente",
                                    "data" => $resume]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }

    }

    public function finish(int $attendanceId, FinishAttendanceRequest $request){
        try{
            $finish = $this->attendanceService->finish($attendanceId,$request->solution);
            return response()->json(["message" => "Atendimento finalizado",
                                    "data" => $finish]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    public function get(){
        try{
            $list = $this->attendanceService->listAttendances();

            return response()->json(["message" => "Listagem de atendimentos",
                                    "data" => $list ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function getById(int $id){
        try{
            $list = $this->attendanceService->listAttendancesById($id);

            return response()->json(["message" => "Listagem de um atendimento",
                                    "data" => $list ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function averageTime(){

        try{
            $average_time = $this->attendanceService->getAvgTime();

            return response()->json(["message" => "Tempo médio de atendimento",
                                    "tempo" => $average_time]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }
    }


}
