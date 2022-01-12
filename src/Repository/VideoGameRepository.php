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

    // public function list()
    // {
    //     $stmt = $this->createQueryBuilder('g');

    //     if(!empty($criteria['query'])){
    //         $stmt->leftJoin('e.place', 'p');

    //         $stmt->where('g.name LIKE :query');
    //         $stmt->orWhere('g.description LIKE :query');
    //         $stmt->orWhere('g.name LIKE :query');
    //         $stmt->setParameter('query', '%' . $criteria['query'] . '%');
    //         $stmt->andWhere('g.category = :category');
    //         $stmt->setParameter('category', $criteria['category']);
    //     }

    //     return $stmt->getQuery()->getResult();
    // }
    // /**
    //  * @return VideoGame[] Returns an array of VideoGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoGame
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
