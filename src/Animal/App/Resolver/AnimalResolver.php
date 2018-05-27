<?php

namespace App\Animal\App\Resolver;

use App\Animal\Domain\AnimalInterface;
use Overblog\GraphQLBundle\Resolver\TypeResolver;

class AnimalResolver
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
     * @param AnimalInterface $animal
     * @return null|string
     * @throws \ReflectionException
     */
    public function resolveType(AnimalInterface $animal): ?string
    {
        return $this->typeResolver->resolve((new \ReflectionClass($animal))->getShortName());
    }
}
