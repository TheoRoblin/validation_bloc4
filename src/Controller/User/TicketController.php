<?php
namespace App\Controller\User;

use App\Repository\TypeRepository;
use App\Repository\TicketRepository;
use Mns\Buggy\Core\AbstractController;


class TicketController extends AbstractController
{
    private TicketRepository $ticketRepository;

    private TypeRepository $typeRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
        $this->typeRepository = new TypeRepository();
    }

    public function index()
    {   
        $tickets = $this->ticketRepository->findAllCreatedBy($_SESSION['user']['id']);
        return $this->render('user/ticket/index.html.php', [
            'title' => 'Tickets',
            'tickets' => $tickets
        ]);
    }

    public function new()
    {
        // Récupération des types
        $types = $this->typeRepository->findAll();

        if(!empty($_POST['ticket']))
        {
            $ticket = $_POST['ticket'];

            if(empty($ticket['title']))
                $errors['title'] = 'Le titre est obligatoire.';

            if(empty($ticket['content']))
                $errors['content'] = 'Le contenu est obligatoire';

            if(count($errors) == 0) {
                $ticket['user_id'] = $_SESSION['user']['id'];

                $id = $this->ticketRepository->insert($ticket);

                header('Location: /user/tickets');
                exit;
            }
        }

        return $this->render('user/ticket/new.html.php', [
            'types' => $types,
            'errors' => $errors
        ]);
    }
}