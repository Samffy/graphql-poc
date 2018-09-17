<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use App\Vehicle\Infra\Repository\VehicleRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class VehicleResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var TypeResolver
     */
    private $typeResolver;

    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;

    /**
     * @param TypeResolver $typeResolver
     * @param VehicleRepositoryInterface $vehicleRepository
     */
    public function __construct(TypeResolver $typeResolver, VehicleRepositoryInterface $vehicleRepository)
    {
        $this->typeResolver = $typeResolver;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param VehicleInterface $vehicle
     * @return null|string
     * @throws \ReflectionException
     */
    public function resolveType(VehicleInterface $vehicle): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($vehicle))->getShortName());
    }

    /**
     * @param string $id
     * @return VehicleInterface|null
     */
    public function resolve(string $id): ?VehicleInterface
    {
        return $this->vehicleRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicle',
        ];
    }
}
