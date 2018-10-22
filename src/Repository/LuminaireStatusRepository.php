<?php

namespace App\Repository;

use App\Entity\LuminaireStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LuminaireStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method LuminaireStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method LuminaireStatus[]    findAll()
 * @method LuminaireStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LuminaireStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LuminaireStatus::class);
    }

//    /**
//     * @return LuminaireStatus[] Returns an array of LuminaireStatus objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LuminaireStatus
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
