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

    public function search($criteria)
    {
        $stmt = $this->createQueryBuilder('g');

        if(!empty($criteria['query'])){
            $stmt->where('g.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }

        return $stmt->getQuery()->getResult();
    }
}