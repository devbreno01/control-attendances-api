<?php

namespace App\DTO;
use App\Http\Requests\PriorityRequest;

class PriorityDto {
    public function __construct(
        public string $name,
        public int $estimated_hours
    ) {}

    public static function fromRequest(PriorityRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            estimated_hours: $request->validated('estimated_hours')
        );
    }

}
