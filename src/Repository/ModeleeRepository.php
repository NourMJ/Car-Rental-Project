<?php

namespace App\Repository;

use App\Entity\Modelee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modelee>
 *
 * @method Modelee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modelee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modelee[]    findAll()
 * @method Modelee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modelee::class);
    }

//    /**
//     * @return Modelee[] Returns an array of Modelee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Modelee
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
