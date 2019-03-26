<?php

namespace App\Repository;

use App\Entity\Cards;
use App\Entity\Cardsearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Cards|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cards|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cards[]    findAll()
 * @method Cards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cards::class);
    }

    // /**
    //  * @return Cards[] Returns an array of Cards objects
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
    public function findOneBySomeField($value): ?Cards
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*public function findByAtk($atk): array
    {
        return ($this->createQueryBuilder('c')
            ->andWhere('c.atk > :atk')
            ->setParameter('atk', $atk)
            ->orderBy('c.atk', 'ASC')
            ->getQuery())
            ->execute()
            ;
    }*/

    public function findAllCards(Cardsearch $search): array
    {
        $query = $this->findAllQuery();

        if($search->getMaxAtk()){
            $query = $query
                ->andwhere('c.atk <= :maxAtk')
                ->andwhere('c.level != 0')
                ->setParameter('maxAtk', $search->getMaxAtk());
        }

        if($search->getMinAtk()){
            $query = $query
                ->andwhere('c.atk >= :minAtk')
                ->andwhere('c.level != 0')
                ->setParameter('minAtk', $search->getMinAtk());
        }

        if($search->getMinDef()){
            $query = $query
                ->andwhere('c.def <= :minDef')
                ->andwhere('c.level != 0')
                ->setParameter('minDef', $search->getMinDef());
        }

        if($search->getMaxDef()){
            $query = $query
                ->andwhere('c.def >= :maxDef')
                ->andwhere('c.level != 0')
                ->setParameter('maxDef', $search->getMaxDef());
        }

        if($search->getMinLevel()){
            $query = $query
                ->andwhere('c.level >= :minLevel')
                ->andwhere('c.level != 0')
                ->setParameter('minLevel', $search->getMinLevel());
        }

        if($search->getMaxLevel()){
            $query = $query
                ->andwhere('c.level <= :maxLevel')
                ->andwhere('c.level != 0')
                ->setParameter('maxLevel', $search->getMaxLevel());
        }

        return $query->getQuery()->execute();
    }

    public function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->andwhere('c.quantity = 1');
    }

}