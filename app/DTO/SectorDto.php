<?php

namespace App\DTO;

use App\Http\Requests\SectorRequest;

class SectorDto {
    public function __construct(
        public string $name
    ) {}

    public static function fromRequest(SectorRequest $request): self
    {
        return new self(
            name: $request->validated('name')
        );
    }
}
