<?php

namespace App\DTO;

use App\Http\Requests\TicketRequest;

class TicketDto {
    public function __construct(
        public string $title,
        public string $description,
        public int $sector_id,
        public int $priority_id,
        public int $status_id,
    ) {}

    public static function fromRequest(TicketRequest $request): self
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            sector_id: $request->validated('sector_id'),
            priority_id: $request->validated('priority_id'),
            status_id: $request->validated('status_id')
        );
    }
}
