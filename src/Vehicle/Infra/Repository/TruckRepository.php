<?php

namespace App\Vehicle\Infra\Repository;

use App\Vehicle\Domain\Truck;
use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

class TruckRepository implements VehicleRepositoryInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $id
     * @return Truck|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(string $id): ?VehicleInterface
    {
        $qb = $this->getRepository()->createQueryBuilder('v');

        $qb->andWhere(
            $qb->expr()->eq(
                'v.id',
                $qb->expr()->literal($id)
            )
        );

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return EntityRepository
     */
    private function getRepository(): EntityRepository
    {
        return $this->em->getRepository(Truck::class);
    }
}
