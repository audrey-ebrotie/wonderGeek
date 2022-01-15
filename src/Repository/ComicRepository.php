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
     * Returns 12 comics per page
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
 * Returns the total number of comics
 * @return void
 */
public function getTotalComics(){
    $query = $this->createQueryBuilder('c')
        ->select('COUNT(c)')
    ;
    return $query->getQuery()->getSingleScalarResult();
}

    // /**
    //  * @return Comic[] Returns an array of Comic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comic
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
