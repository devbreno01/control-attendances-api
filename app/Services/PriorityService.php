<?php

namespace App\Services;
use App\DTO\PriorityDto;
use App\Repositories\PriorityRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class PriorityService{

    private int $tenant_id;

    public function __construct()
    {
        $this->tenant_id = Auth::user()->tenant_id;
    }

    private static function repository(){
        return new PriorityRepository;
    }

    public function get(){
        return self::repository()->all();

    }

    public function getById(int $id){
        return self::repository()->find($id);
    }

    public function store(PriorityDto $dto){

        if($dto->estimated_hours <= 0  ){
            throw new Exception("A hora não pode ser igual ou menor a 0");
        }

        $priority = self::repository()->create([
            "tenant_id" => $this->tenant_id,
            "name" => $dto->name,
            "estimated_hours" => $dto->estimated_hours
        ]);

        return $priority;
    }

    public function update(int $id, PriorityDto $dto){
        return self::repository()->update($id, [
            "name" => $dto->name
        ]);
    }

    public function delete(int $id){
        return self::repository()->delete($id);
    }
}
