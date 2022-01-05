<?php

namespace App\Repository;

use App\Entity\ComicCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ComicCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComicCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComicCategory[]    findAll()
 * @method ComicCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComicCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComicCategory::class);
    }

    // /**
    //  * @return ComicCategory[] Returns an array of ComicCategory objects
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
    public function findOneBySomeField($value): ?ComicCategory
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
