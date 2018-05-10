<?php

namespace App\Person\App\Resolver;

use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;
use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Infra\Repository\VehicleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * @param PersonRepositoryInterface $personRepository
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository, VehicleRepository $vehicleRepository) {
        $this->personRepository = $personRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param string $id
     * @return Person|null
     */
    public function resolve(string $id): ?Person
    {
        return $this->personRepository->find($id);
    }

    /**
     * @param Person $person
     * @return VehicleInterface|null
     */
    public function resolveVehicle(Person $person): ?VehicleInterface
    {
        return $this->vehicleRepository->findByPerson($person);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Person',
        ];
    }
}
