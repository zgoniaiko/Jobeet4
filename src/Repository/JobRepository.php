<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function getActiveJobsQuery()
    {
        return $this->createQueryBuilder('j')
            ->where('j.expiresAt > :expiryAt')
            ->setParameter('expiryAt', new \DateTime())
            ->getQuery();
    }

    public function getActiveJobsPaginator(int $page, int $max = 20)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->getActiveJobsQuery()));
        $paginator->setMaxPerPage($max);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
     * @return Job[] Returns an array of Job objects
     */
    public function findActiveJobs()
    {
        return $this->getActiveJobsQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Job|null
     */
    public function findActiveJob(int $id): ?Job
    {
        return $this->createQueryBuilder('j')
            ->where('j.id = :id')
            ->andWhere('j.expiresAt > :expiryAt')
            ->setParameter('id', $id)
            ->setParameter('expiryAt', new \DateTime())
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Job[] Returns an array of Job objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Job
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
