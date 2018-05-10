<?php

namespace App\Vehicle\App\Resolver;

use App\Person\Domain\Person;
use App\Vehicle\App\Query\VehiclesQuery;
use App\Vehicle\Infra\Repository\VehicleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class VehiclesResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param string|null $personId
     * @param string|null $vehicleId
     * @return array
     */
    public function resolve(string $personId = null, string $vehicleId = null): array
    {
        $query = new VehiclesQuery($personId, $vehicleId);

        return $this->vehicleRepository->findAll($query);
    }

    /**
     * @param Person $person
     * @param string|null $id
     * @return array|null
     */
    public function resolveByPerson(Person $person, string $id = null): ?array
    {
        $query = new VehiclesQuery($person->getId(), $id);

        return $this->vehicleRepository->findAll($query);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicles',
        ];
    }
}
