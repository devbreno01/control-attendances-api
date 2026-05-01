<?php

namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Ticket;

class TicketRepository extends AbstractRepository{
    protected static $model = Ticket::class;
}
