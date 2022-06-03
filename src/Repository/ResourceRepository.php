<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Resource;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Resource>
 *
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function add(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Resource[] Returns an array of Resource objects
    */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('r')
            ->select('c', 'a', 'r')
            ->join('r.category', 'c')
            ->join('r.ambiance', 'a')
        ;

        if (!empty($search->q)) {
            $query = $query
                ->orWhere('r.artistname LIKE :q')
                ->orWhere('r.trackname LIKE :q')
                ->orWhere('r.description LIKE :q')
                ->orWhere('c.label LIKE :q')
                ->orWhere('a.label LIKE :q')
                ->setParameter('q', "%{$search->q}%")
            ;
        }

        return $query->getQuery()->getResult();
    }

//    public function findOneBySomeField($value): ?Resource
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}