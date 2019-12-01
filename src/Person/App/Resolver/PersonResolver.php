<?php

namespace App\Person\App\Resolver;

use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonResolver implements ResolverInterface, AliasedInterface
{
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function resolve(string $id): ?Person
    {
        return $this->personRepository->find($id);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Person',
        ];
    }
}
