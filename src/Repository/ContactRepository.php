<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Contact>
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[] Returns an array of Contact objects
     */
    public function searchAndPaginate(int $page, int $limit, ?string $search = ''): array
    {
        $offset = ($page - 1) * $limit;

        $qb = $this->createQueryBuilder('c');
        return $qb
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('c.firstName', ':search'),
                    $qb->expr()->like('c.name', ':search'),
                ),
            )
            ->setParameter('search', '%'.$search.'%')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    public function countBySearch(?string $search = ''): int
    {
        $qb = $this->createQueryBuilder('c');
        return $qb
            ->select($qb->expr()->count('c.id'))
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('c.firstName', ':search'),
                    $qb->expr()->like('c.name', ':search'),
                ),
            )
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
