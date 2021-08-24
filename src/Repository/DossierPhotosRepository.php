<?php

namespace App\Repository;

use App\Entity\DossierPhotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DossierPhotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierPhotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierPhotos[]    findAll()
 * @method DossierPhotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierPhotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierPhotos::class);
    }

    // /**
    //  * @return DossierPhotos[] Returns an array of DossierPhotos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DossierPhotos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
