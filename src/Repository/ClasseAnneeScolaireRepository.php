<?php

namespace App\Repository;

use App\Entity\ClasseAnneeScolaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClasseAnneeScolaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseAnneeScolaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseAnneeScolaire[]    findAll()
 * @method ClasseAnneeScolaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseAnneeScolaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseAnneeScolaire::class);
    }

    // /**
    //  * @return ClasseAnneeScolaire[] Returns an array of ClasseAnneeScolaire objects
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
    public function findOneBySomeField($value): ?ClasseAnneeScolaire
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
