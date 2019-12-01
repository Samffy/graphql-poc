<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\VehicleInterface;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class VehicleResolver implements ResolverInterface, AliasedInterface
{
    private $typeResolver;
    private $vehicleRepository;

    public function __construct(TypeResolver $typeResolver, VehicleRepositoryInterface $vehicleRepository)
    {
        $this->typeResolver = $typeResolver;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @throws \ReflectionException
     */
    public function resolveType(VehicleInterface $vehicle): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($vehicle))->getShortName());
    }

    public function resolve(string $id): ?VehicleInterface
    {
        return $this->vehicleRepository->find($id);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicle',
        ];
    }
}
