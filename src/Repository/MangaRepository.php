<?php

namespace App\Repository;

use App\Entity\Manga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Manga|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manga|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manga[]    findAll()
 * @method Manga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MangaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manga::class);
    }

    /**
     * Pagination : renvoi 12 élements par page
     * @return void
     */
    public function getPaginatedMangas($page, $limit){
        $query = $this->createQueryBuilder('m')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit)
    ;
    return $query->getQuery()->getResult();
}

/**
 * Pagination : renvoi le nombre total d'éléments
 * @return void
 */
public function getTotalMangas(){
    $query = $this->createQueryBuilder('m')
        ->select('COUNT(m)')
    ;
    return $query->getQuery()->getSingleScalarResult();
}

// Formulaire de recherche 

    public function search($criteria){
        $stmt = $this->createQueryBuilder('m');
    
        if(!empty($criteria['query'])){
            $stmt->leftJoin('m.category', 'c');
            
            $stmt->where('m.name LIKE :query');
            $stmt->orwhere('m.author LIKE :query');
            $stmt->orwhere('c.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }
    
        return $stmt->getQuery()->getResult();
    }
    
    }