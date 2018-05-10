<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\VehicleInterface;
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
    public function resolve(VehicleInterface $vehicle): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($vehicle))->getShortName());
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
