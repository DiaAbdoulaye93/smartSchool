<?php

namespace App\Repository;

use App\Entity\MatiereClasseAnneeScolair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatiereClasseAnneeScolair|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatiereClasseAnneeScolair|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatiereClasseAnneeScolair[]    findAll()
 * @method MatiereClasseAnneeScolair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatiereClasseAnneeScolairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatiereClasseAnneeScolair::class);
    }

    // /**
    //  * @return MatiereClasseAnneeScolair[] Returns an array of MatiereClasseAnneeScolair objects
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
    public function findOneBySomeField($value): ?MatiereClasseAnneeScolair
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
