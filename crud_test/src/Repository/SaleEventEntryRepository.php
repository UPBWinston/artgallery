<?php

namespace App\Repository;

use App\Entity\SaleEventEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaleEventEntry>
 *
 * @method SaleEventEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaleEventEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaleEventEntry[]    findAll()
 * @method SaleEventEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaleEventEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaleEventEntry::class);
    }

    public function save(SaleEventEntry $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SaleEventEntry $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SaleEventEntry[] Returns an array of SaleEventEntry objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SaleEventEntry
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
