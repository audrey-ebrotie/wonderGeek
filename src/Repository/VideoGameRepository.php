<?php

namespace App\Repository;

use App\Entity\VideoGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoGame[]    findAll()
 * @method VideoGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoGame::class);
    }

/**
     * Pagination : renvoi 12 élements par page
     * @return void
     */
    public function getPaginatedVideoGames($page, $limit){
        $query = $this->createQueryBuilder('v')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit)
    ;
    return $query->getQuery()->getResult();
}

/**
 * Pagination : renvoi le nombre total d'éléments
 * @return void
 */
public function getTotalVideoGames(){
    $query = $this->createQueryBuilder('v')
        ->select('COUNT(v)')
    ;
    return $query->getQuery()->getSingleScalarResult();
}

/**
 * Formulaire de recherche
*/ 
    public function search($criteria)
    {
        $stmt = $this->createQueryBuilder('g');

        if(!empty($criteria['query'])){
            $stmt->leftJoin('g.category', 'c');
            $stmt->leftJoin('g.platform', 'p');

            $stmt->where('g.name LIKE :query');
            $stmt->orwhere('c.name LIKE :query');
            $stmt->orwhere('p.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }

        return $stmt->getQuery()->getResult();
    }
}
