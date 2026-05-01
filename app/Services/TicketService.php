<?php

namespace App\Services;
use App\Repositories\TicketRepository;
use App\DTO\TicketDto;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketService{

    private int $tenant_id;

    public function __construct()
    {
        $this->tenant_id = Auth::user()->tenant_id;
    }

    private static function repository(){
        return new TicketRepository;
    }

      public function get(){
        return self::repository()->all();

    }

    public function getById(int $id){
        return self::repository()->find($id);
    }

    public function store(TicketDto $dto){

        $sector = DB::table('sectors')->where('id', '=' , $dto->sector_id)->first();

        if(!$sector){
            throw new Exception("Setor associado não existe! Por favor, verifique e tente novamente");
        }

        $priority = DB::table('priorities')->where('id', '=' , $dto->priority_id)->first();
        if(!$priority){
            throw new Exception("Prioridade associada não existe! Por favor, verifique e tente novamente");
        }

        $status = DB::table('statuses')->where('id', '=' , $dto->status_id)->first();
        if(!$status){
            throw new Exception("Status associado não existe! Por favor, verifique e tente novamente");
        }


        $ticket = self::repository()->create([
            "tenant_id" => $this->tenant_id,
            "title" => $dto->title,
            "description" => $dto->description,
            "priority_id" => $dto->priority_id,
            "status_id" => $dto->status_id,
            "sector_id" => $dto->sector_id
        ]);

        return $ticket;
    }

    public function update(int $id, TicketDto $dto){
        return self::repository()->update($id, [
            "title" => $dto->title,
            "description" => $dto->description,
            "priority_id" => $dto->priority_id,
            "status_id" => $dto->status_id,
            "sector_id" => $dto->sector_id
        ]);
    }

    public function delete(int $id){
        return self::repository()->delete($id);
    }

}
