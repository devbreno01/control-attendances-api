<?php

namespace App\DTO;
use App\Http\Requests\PriorityRequest;

class PriorityDto {
    public function __construct(
        public string $name,
        public string $estimated_time
    ) {}

    public static function fromRequest(PriorityRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            estimated_time: $request->validated('estimated_time')
        );
    }

}
