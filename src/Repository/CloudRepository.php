<?php

namespace App\Repository;

use App\Entity\Cloud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cloud>
 *
 * @method Cloud|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cloud|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cloud[]    findAll()
 * @method Cloud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CloudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cloud::class);
    }

    public function saveCloud(Cloud $cloud): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($cloud);
        $entityManager->flush();
    }

//    /**
//     * @return Cloud[] Returns an array of Cloud objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cloud
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
