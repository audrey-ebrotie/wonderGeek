<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Pagination : renvoi 18 élements par page
     * @return void
     */
    public function getPaginatedUsers($page, $limit){
        $query = $this->createQueryBuilder('u')
        ->setFirstResult(($page * $limit) - $limit)
        ->setMaxResults($limit)
    ;
    return $query->getQuery()->getResult();
}

/**
 * Pagination : renvoi le nombre total d'éléments
 * @return void
 */
public function getTotalUsers(){
    $query = $this->createQueryBuilder('u')
        ->select('COUNT(u)')
    ;
    return $query->getQuery()->getSingleScalarResult();
}

// public function search($criteria)
// {
//     $stmt = $this->createQueryBuilder('u');

//     if(!empty($criteria['query'])){
//         $stmt->where('u.username LIKE :query');
//         $stmt->setParameter('query', '%' . $criteria['query'] . '%');
//         }

//     return $stmt->getQuery()->getResult();
// }

}
