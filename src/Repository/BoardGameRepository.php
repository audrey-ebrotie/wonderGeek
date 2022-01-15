<?php

namespace App\Repository;

use App\Entity\BoardGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BoardGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoardGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoardGame[]    findAll()
 * @method BoardGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoardGame::class);
    }

/**
 * Pagination : renvoi 12 élements par page
 * @return void
 */
public function getPaginatedBoardGames($page, $limit){
    $query = $this->createQueryBuilder('b')
    ->setFirstResult(($page * $limit) - $limit)
    ->setMaxResults($limit)
    ;
    return $query->getQuery()->getResult();
}

/**
 * Pagination : renvoi le nombre total d'éléments
 * @return void
 */
    public function getTotalBoardGames(){
        $query = $this->createQueryBuilder('b')
            ->select('COUNT(b)')
        ;
        return $query->getQuery()->getSingleScalarResult();
    }

// Formulaire de recherche
    public function search($criteria){
        $stmt = $this->createQueryBuilder('b');
    
        if(!empty($criteria['query'])){
            $stmt->leftJoin('b.category', 'c');

            $stmt->where('b.name LIKE :query');
            $stmt->orwhere('c.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }
    
        return $stmt->getQuery()->getResult();
    }
    
    }