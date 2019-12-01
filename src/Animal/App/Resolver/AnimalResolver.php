<?php

namespace App\Animal\App\Resolver;

use App\Animal\Domain\AnimalInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class AnimalResolver
{
    private $typeResolver;

    public function __construct(TypeResolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
    }

    /**
     * @throws \ReflectionException
     */
    public function resolveType(AnimalInterface $animal): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($animal))->getShortName());
    }
}
