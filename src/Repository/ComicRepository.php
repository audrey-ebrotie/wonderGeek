<?php

namespace App\Repository;

use App\Entity\Comic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comic[]    findAll()
 * @method Comic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comic::class);
    }

    /**
     * Pagination : renvoi 12 élements par page
     * @return void
     */
    public function getPaginatedComics($page, $limit){
        $query = $this->createQueryBuilder('c')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit)
    ;
    return $query->getQuery()->getResult();
}

/**
 * Pagination : Renvoi le nombre total d'éléments
 * @return void
 */
    public function getTotalComics(){
    $query = $this->createQueryBuilder('c')
        ->select('COUNT(c)')
    ;
    return $query->getQuery()->getSingleScalarResult();
    }

// Formulaire de recherche
    public function search($criteria){
        $stmt = $this->createQueryBuilder('c');

        if(!empty($criteria['query'])){
            $stmt->where('c.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }
        
    return $stmt->getQuery()->getResult();
    }

}
