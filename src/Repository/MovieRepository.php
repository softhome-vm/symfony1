<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Movie> */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function findRandom(): ?Movie
    {
        $count = (int) $this->createQueryBuilder('movie')
            ->select('COUNT(movie.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if ($count === 0) {
            return null;
        }

        return $this->createQueryBuilder('movie')
            ->orderBy('movie.id', 'ASC')
            ->setMaxResults(1)
            ->setFirstResult(random_int(0, $count - 1))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
