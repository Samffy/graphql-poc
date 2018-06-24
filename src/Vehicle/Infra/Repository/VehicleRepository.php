<?php

namespace App\Vehicle\Infra\Repository;

use App\Common\Infra\Repository\DataRepository;
use App\Vehicle\App\Query\VehiclesQuery;
use App\Person\Domain\Person;
use App\Vehicle\Domain\VehicleAbstract;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

class VehicleRepository
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
     * @param Person $person
     * @return array
     */
    public function findByPerson(Person $person): array
    {
        $qb = $this->getRepository()->createQueryBuilder('v');

        $qb
            ->innerJoin(Person::class, 'p')
            ->innerJoin('p.vehicles', 'phv', \Doctrine\ORM\Query\Expr\Join::WITH, 'phv.id = v.id')
            ->andWhere(
                $qb->expr()->eq(
                    'p.id',
                    $qb->expr()->literal($person->getId())
                )
            );

        return $qb->getQuery()->getResult();
    }

    /**
     * @param VehiclesQuery $query
     * @return array
     */
    public function findAll(VehiclesQuery $query): array
    {
        $qb = $this->getRepository()->createQueryBuilder('v');

        if ($query->hasPersonId()) {
            $qb
                ->innerJoin(Person::class, 'p')
                ->innerJoin('p.vehicles', 'phv', \Doctrine\ORM\Query\Expr\Join::WITH, 'phv.id = v.id')
                ->andWhere(
                    $qb->expr()->eq(
                        'p.id',
                        $qb->expr()->literal($query->getPersonId())
                    )
                )
            ;
        }

        if ($query->hasVehicleId()) {
            $qb->andWhere(
                $qb->expr()->eq(
                    'v.id',
                    $qb->expr()->literal($query->getVehicleId())
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
        return $this->em->getRepository(VehicleAbstract::class);
    }
}
