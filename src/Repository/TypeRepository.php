<?php
namespace App\Repository;

use App\Entity\Type;
use App\Utils\EntityMapper;
use Mns\Buggy\Core\AbstractRepository;

class TypeRepository extends AbstractRepository
{

    public function findAll()
    {
        $types = $this->getConnection()->query("SELECT * FROM type")->fetchAll();
        return EntityMapper::mapCollection(Type::class, $types);
    }

    public function find(int $id)
    {
        $type = $this->getConnection()->query("SELECT * FROM type t WHERE t.id = $id")->fetch();
        return EntityMapper::map(Type::class, $type);
    }

}