<?php

namespace App\Person\Infra\Repository;

use App\Person\App\Query\PersonsQuery;
use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PersonRepository implements PersonRepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(string $id): ?Person
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $qb->andWhere(
            $qb->expr()->eq(
                'p.id',
                $qb->expr()->literal($id)
            )
        );

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findAll(PersonsQuery $query): array
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        if ($query->hasPersonId()) {
            $qb->andWhere(
                $qb->expr()->eq(
                    'p.id',
                    $qb->expr()->literal($query->getPersonId())
                )
            );
        }

        return $qb->getQuery()->getResult();
    }

    private function getRepository(): EntityRepository
    {
        return $this->em->getRepository(Person::class);
    }
}
