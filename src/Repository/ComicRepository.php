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

    public function search($criteria){
        $stmt = $this->createQueryBuilder('c');
    
        if(!empty($criteria['query'])){
            $stmt->leftJoin('c.category', 'a');
            $stmt->where('c.name LIKE :query');
            $stmt->orwhere('c.author LIKE :query');
            $stmt->orwhere('a.name LIKE :query');
            $stmt->setParameter('query', '%' . $criteria['query'] . '%');
        }
    
        return $stmt->getQuery()->getResult();
    }
    
    }
