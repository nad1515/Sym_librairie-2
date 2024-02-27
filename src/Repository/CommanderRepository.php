<?php

namespace App\Repository;

use App\Entity\Commander;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commander>
 *
 * @method Commander|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commander|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commander[]    findAll()
 * @method Commander[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommanderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commander::class);
    }

//    /**
//     * @return Commander[] Returns an array of Commander objects
//     */
   public function findAllCommandesWithJointures(): array
   {
       return $this->createQueryBuilder('c')
           ->leftJoin('c.Id_Livre', 'l')
           ->leftJoin('c.Id_fournisseur', 'f')
           ->leftJoin('c.idUtilisateur', 'u')
           ->addSelect('l','f', 'u')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Commander
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
