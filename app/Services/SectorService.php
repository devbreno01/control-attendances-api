<?php

namespace App\Services;

use App\DTO\SectorDto;
use App\Repositories\SectoreRepository;
use Illuminate\Support\Facades\Auth;

class SectorService{

    private int $tenant_id;

    public function __construct()
    {
        $this->tenant_id = Auth::user()->tenant_id;
    }

    private static function repository(){
        return new SectoreRepository;
    }

    public function get(){
        return self::repository()->all();

    }

    public function getById(int $id){
        return self::repository()->find($id);
    }

    public function store(SectorDto $dto){
        $sector = self::repository()->create([
            "tenant_id" => $this->tenant_id,
            "name" => $dto->name
        ]);

        return $sector;
    }

    public function update(int $id, SectorDto $dto){
        return self::repository()->update($id, [
            "name" => $dto->name
        ]);
    }

    public function delete(int $id){
        return self::repository()->delete($id); 
    }
}
