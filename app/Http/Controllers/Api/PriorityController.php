<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PriorityService;
use App\Http\Requests\PriorityRequest;
use App\DTO\PriorityDto;
class PriorityController extends Controller
{
    private $priorityService;

    public function __construct(PriorityService $service)
    {
        $this->priorityService = $service;
    }

    public function store(PriorityRequest $request){
        $dto = PriorityDto::fromRequest($request);

        try{
            $priority = $this->priorityService->store($dto);

            return response()->json(["message" => "Prioridade criada com sucesso",
                                    "data" => $priority
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function get(){
        try{
            $priorities = $this->priorityService->get();

            return response()->json(["message" => "Listagem de prioridades",
                                    "data" =>  $priorities
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function getById( int $id){
        try{
            $priority = $this->priorityService->getById($id);

            return response()->json(["message" => "Listagem da prioridade",
                                    "data" =>  $priority
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function update(PriorityRequest $request, int $id){
        $dto = PriorityDto::fromRequest($request);
        try{
            $priority = $this->priorityService->update($id,$dto);

            return response()->json(["message" => "Prioridade atualizada com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function delete(int $id){
        try{
            $priority = $this->priorityService->delete($id);

            return response()->json(["message" => "Prioridade deletada com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

}
