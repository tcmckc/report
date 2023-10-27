<?php

namespace App\Repository;

use App\Entity\GCP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GCP>
 *
 * @method GCP|null find($id, $lockMode = null, $lockVersion = null)
 * @method GCP|null findOneBy(array $criteria, array $orderBy = null)
 * @method GCP[]    findAll()
 * @method GCP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GCPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GCP::class);
    }

//    /**
//     * @return GCP[] Returns an array of GCP objects
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

//    public function findOneBySomeField($value): ?GCP
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
