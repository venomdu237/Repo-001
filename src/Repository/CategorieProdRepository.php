<?php

namespace App\Repository;

use App\Entity\CategorieProd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieProd|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieProd|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieProd[]    findAll()
 * @method CategorieProd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieProdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieProd::class);
    }

    /**
     * @return CategorieProd[] Returns an array of CategorieProd objects
     */
    public function findAllCategories()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categorieParent is null')
            ->orderBy('c.ordre', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return CategorieProd[] Returns an array of CategorieProd objects
     */
    public function findSousCategories()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categorieParent is not null')
            ->orderBy('c.ordre', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findSousCategoriesById(array $enabledCategories)
    {
        $qb = $this->createQueryBuilder('c');
        return
            $qb->andWhere('c.categorieParent is not null')
                ->orderBy('c.ordre', 'ASC')
                ->andWhere("c.id in (:enabled)")
                ->setParameter(":enabled",$enabledCategories)
                ->andWhere()
                ->getQuery()
                ->getResult()
            ;
    }
    /**
     * @return QueryBuilder
     */
    public function findAllCategoriesForm()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categorieParent is null')
            ->orderBy('c.ordre', 'ASC')
            ;
    }

    // /**
    //  * @return CategorieProd[] Returns an array of CategorieProd objects
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
    public function findOneBySomeField($value): ?CategorieProd
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
