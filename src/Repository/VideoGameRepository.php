<?php

namespace App\Repository;

use App\Entity\VideoGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function list()
    {
        $stmt = $this->createQueryBuilder('g');

        if(!empty($criteria['query'])){
            $stmt->leftJoin('e.place', 'p');

            $stmt->where('g.name LIKE :query');
            $stmt->orWhere('g.description LIKE :query');
            $stmt->orWhere('g.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
            $stmt->andWhere('g.category = :category');
            $stmt->setParameter('category', $criteria['category']);
        }

        return $stmt->getQuery()->getResult();
    }
    // /**
    //  * @return Game[] Returns an array of Game objects
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
