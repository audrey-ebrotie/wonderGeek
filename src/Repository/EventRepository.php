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

    /**
     * Pagination : renvoi 12 élements par page
     * @return void
     */
    public function getPaginatedEvents($page, $limit){
            $query = $this->createQueryBuilder('e')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit)

        ;
        return $query->getQuery()->getResult();
    }

    /**
     * Pagination : renvoi le nombre total d'éléments
     * @return void
     */
    public function getTotalEvents(){
        $query = $this->createQueryBuilder('e')
            ->select('COUNT(e)')
        ;
        return $query->getQuery()->getSingleScalarResult();
    }

// Formulaire de recherche
    public function search($criteria){
        $stmt = $this->createQueryBuilder('e');

        if(!empty($criteria['query'])){
            $stmt->where('e.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }

        return $stmt->getQuery()->getResult();
    }

}
