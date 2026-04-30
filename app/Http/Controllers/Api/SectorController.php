<?php

namespace App\Http\Controllers\Api;

use App\DTO\SectorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectorRequest;
use App\Services\SectorService;
use Illuminate\Http\Request;


class SectorController extends Controller
{
    private $sectorService;

    public function __construct(SectorService $service)
    {
        $this->sectorService = $service;
    }

    public function store(SectorRequest $request){
        $dto = SectorDto::fromRequest($request);

        try{
            $sector = $this->sectorService->store($dto);

            return response()->json(["message" => "Setor criado com sucesso",
                                    "data" => $sector
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function get(){
        try{
            $sectors = $this->sectorService->get();

            return response()->json(["message" => "Listagem de setores",
                                    "data" =>  $sectors
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function getById( int $id){
        try{
            $sector = $this->sectorService->getById($id);

            return response()->json(["message" => "Listagem do setor",
                                    "data" =>  $sector
            ]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function update(SectorRequest $request, int $id){
        $dto = SectorDto::fromRequest($request);
        try{
            $sector = $this->sectorService->update($id,$dto);

            return response()->json(["message" => "Setor atualizado com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }


    }

    public function delete(int $id){
        try{
            $sector = $this->sectorService->delete($id);

            return response()->json(["message" => "Setor deletado com sucesso"]);

        }catch(\Exception $e){
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
    }


}
