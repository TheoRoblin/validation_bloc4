<?php
namespace App\Controller\Admin;

use App\Repository\TicketRepository;
use Mns\Buggy\Core\AbstractController;


class DashboardController extends AbstractController
{
    private TicketRepository $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
    }

    public function index()
    {   
        // Récupération de tous les tickets ouverts
        $tickets = $this->ticketRepository->findAllOpenedTickets();
        return $this->render('admin/dashboard/index.html.php', [
            'title' => 'Dashboard',
            'tickets' => $tickets
        ]);
    }
}