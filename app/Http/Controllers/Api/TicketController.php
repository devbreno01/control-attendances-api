<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use App\DTO\TicketDto;


class TicketController extends Controller
{
    private $ticketService;

    public function __construct(TicketService $service)
    {
        $this->ticketService = $service;
    }

    public function store(TicketRequest $request){
        $dto = TicketDto::fromRequest($request);

        try{
            $ticket = $this->ticketService->store($dto);

            return response()->json(["message" => "Ticket criado com sucesso",
                                    "data" => $ticket
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function get(){
        try{
            $tickets = $this->ticketService->get();

            return response()->json(["message" => "Listagem de tickets",
                                    "data" =>  $tickets
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function getById( int $id){
        try{
            $ticket = $this->ticketService->getById($id);

            return response()->json(["message" => "Listagem da ticket",
                                    "data" =>  $ticket
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function update(TicketRequest $request, int $id){
        $dto = TicketDto::fromRequest($request);
        try{
            $ticket = $this->ticketService->update($id,$dto);

            return response()->json(["message" => "Ticket atualizado com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function delete(int $id){
        try{
            $ticket = $this->ticketService->delete($id);

            return response()->json(["message" => "Ticket deletado com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }
}
