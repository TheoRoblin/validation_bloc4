<?php
namespace App\Controller\Admin;

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
        // Récupération de tous les tickets ouverts
        if(!isset($_GET['closed']))
        {
            $tickets = $this->ticketRepository->findAllNewTickets();
        }
        else
        {
            $tickets = $this->ticketRepository->findAllNewAndClosedTickets();
        }

        
        return $this->render('admin/ticket/index.html.php', [
            'title' => 'Tickets',
            'tickets' => $tickets
        ]);
    }

    public function show()
    {
        try {
            if(empty($_GET['id']))
                throw new \Exception('Identifiant du ticket manquant.');

            $ticket = $this->ticketRepository->find($_GET['id']);

            if(!$ticket)
                throw new \Exception('Ticket not found.');

            // On met à jour le status du ticket s'il n'est pas fermé
            if(!$ticket->getClosedat())
                $this->ticketRepository->open($ticket->getId());

            return $this->render('admin/ticket/show.html.php', [
                'ticket' => $ticket
            ]);
        }
        catch (\Exception $e) 
        {
            return $this->render('shared/error.html.php', [
                'message' => $e->getMessage()
            ]);
        }
    }

    public function close()
    {
        try {
            if(empty($_GET['id']))
                throw new \Exception('Identifiant du ticket manquant.');

            $this->ticketRepository->close($_GET['id']);

            header('Location: /admin/ticket/show?id='.$_GET['id']);
            exit;
        }
        catch (\Exception $e) 
        {
            return $this->render('shared/error.html.php', [
                'message' => $e->getMessage()
            ]);
        }
    }
}