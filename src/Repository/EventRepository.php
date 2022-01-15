<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function search($criteria){
        $stmt = $this->createQueryBuilder('e');

        if(!empty($criteria['query'])){
            $stmt->leftJoin('e.activity', 'a');
            $stmt->leftJoin('e.category', 'c');

            $stmt->where('a.name LIKE :query');
            $stmt->orwhere('e.name LIKE :query');
            $stmt->orwhere('c.name LIKE :query');
            
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }

        return $stmt->getQuery()->getResult();
}

}
