<?php
namespace App\Repository;

use App\Entity\Ticket;
use App\Utils\EntityMapper;
use Mns\Buggy\Core\AbstractRepository;

class TicketRepository extends AbstractRepository
{

    private function _getBaseQuery()
    {
        return 
        "SELECT t.id, t.title, t.content, CONCAT(mns_user.firstname,' ',mns_user.lastname) as createdby, t.createdat, t.openedat, t.closedat, type.label as type, type.color as color
        FROM ticket t
        JOIN mns_user ON mns_user.id = t.user_id
        JOIN type ON type.id = t.type_id ";
    }

    public function findAll()
    {
        $tickets = $this->getConnection()->query($this->_getBaseQuery())->fetchAll();
        return EntityMapper::mapCollection(Ticket::class, $tickets);
    }

    public function find(int $id)
    {
        $ticket = $this->getConnection()->query($this->_getBaseQuery() . "WHERE t.id = $id")->fetch();
        return EntityMapper::map(Ticket::class, $ticket);
    }

    public function findAllOpenedTickets()
    {
        $tickets = $this->getConnection()->query($this->_getBaseQuery() . "WHERE t.openedat IS NOT NULL AND t.closedat IS NULL")->fetchAll();
        return EntityMapper::mapCollection(Ticket::class, $tickets);
    }

    public function findAllNewTickets()
    {
        $tickets = $this->getConnection()->query($this->_getBaseQuery() . "WHERE t.openedat IS NULL AND t.closedat IS NULL")->fetchAll();
        return EntityMapper::mapCollection(Ticket::class, $tickets);
    }

    public function findAllNewAndClosedTickets()
    {
        $tickets = $this->getConnection()->query($this->_getBaseQuery() . "WHERE t.openedat IS NULL AND t.closedat IS NOT NULL")->fetchAll();
        return EntityMapper::mapCollection(Ticket::class, $tickets);
    }

    public function findAllCreatedBy(int $userId)
    {
        $tickets = $this->getConnection()->query($this->_getBaseQuery() . "WHERE t.user_id = $userId")->fetchAll();
        return EntityMapper::mapCollection(Ticket::class, $tickets);
    }

    public function open(int $id)
    {
        $sql = "UPDATE ticket t SET t.openedat = NOW() WHERE id = :id AND t.closedat IS NULL";
        $query = $this->getConnection()->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
        return $query->rowCount();
    }

    public function close(int $id)
    {
        $sql = "UPDATE ticket t SET t.closedat = NOW() WHERE id = :id AND t.closedat IS NULL";
        $query = $this->getConnection()->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
        return $query->rowCount();
    }

    public function insert(array $data = array())
    {
        $sql = "INSERT INTO ticket (title, content, createdat, type_id, user_id) VALUES (:title, :content, NOW(), :type_id, :user_id)";
        $query = $this->getConnection()->prepare($sql);
        $query->execute($data);
        return $this->getConnection()->lastInsertId();
    }

}