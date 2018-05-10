<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\VehicleInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class VehicleResolver
{
    /**
     * @var TypeResolver
     */
    private $typeResolver;

    /**
     * @param TypeResolver $typeResolver
     */
    public function __construct(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
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
}
