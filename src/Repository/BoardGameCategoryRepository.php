<?php

namespace App\Repository;

use App\Entity\BoardGameCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BoardGameCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoardGameCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoardGameCategory[]    findAll()
 * @method BoardGameCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardGameCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoardGameCategory::class);
    }

    // /**
    //  * @return BoardGameCategory[] Returns an array of BoardGameCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BoardGameCategory
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
