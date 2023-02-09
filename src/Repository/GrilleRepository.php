<?php

namespace App\Repository;

use App\Entity\Grille;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Grille>
 *
 * @method Grille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grille[]    findAll()
 * @method Grille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grille::class);
    }

    public function save(Grille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Grille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function nbGrillesEnCoursUser(UserInterface $user)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.user = :user')
            ->andWhere('g.date > :date')
            ->setParameter('user', $user)
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getResult();
    }

    public function nbGrillesEnCours(\DateTime $date)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.date > :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Grille[] Returns an array of Grille objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Grille
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
