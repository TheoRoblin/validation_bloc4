<?php

namespace App\Controller\Api;

use App\Repository\TicketRepository;
use Mns\Buggy\Core\AbstractController;

class TicketController extends AbstractController
{
    private TicketRepository $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
    }

    public function index()
    {
        return $this->json([
            'tickets' => $this->ticketRepository->findAll()
        ]);
    }

}