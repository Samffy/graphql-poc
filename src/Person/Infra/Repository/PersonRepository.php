<?php

namespace App\Person\Infra\Repository;

use App\Person\App\Query\PersonsQuery;
use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $id
     * @return Person|null
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

    /**
     * @param PersonsQuery $query
     * @return array
     */
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

    /**
     * @return EntityRepository
     */
    private function getRepository(): EntityRepository
    {
        return $this->em->getRepository(Person::class);
    }
}
