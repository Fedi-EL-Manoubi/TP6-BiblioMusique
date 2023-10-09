<?php

namespace App\Repository;

use App\Entity\Artiste;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Artiste>
 *
 * @method Artiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artiste[]    findAll()
 * @method Artiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

    public function add(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Artiste[] Returns an array of Artiste objects
    */

   public function listeArtistesComplete()
   {
       return $this->createQueryBuilder('art')
            ->select('art','a')
            ->innerJoin('art.albums','a')
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }

      /**
    * @return Query Returns an array of Artiste objects
    */

    public function listeArtistesCompletePaginee() : Query 
    {
        return $this->createQueryBuilder('art')
             ->select('art','a')
             ->innerJoin('art.albums','a')
             ->orderBy('art.nom', 'ASC')
             ->getQuery()
        ;
    }

//    public function findOneBySomeField($value): ?Artiste
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
