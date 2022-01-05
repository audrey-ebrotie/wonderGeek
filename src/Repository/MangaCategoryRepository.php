<?php

namespace App\Repository;

use App\Entity\MangaCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MangaCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MangaCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MangaCategory[]    findAll()
 * @method MangaCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MangaCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MangaCategory::class);
    }

    // /**
    //  * @return MangaCategory[] Returns an array of MangaCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MangaCategory
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
