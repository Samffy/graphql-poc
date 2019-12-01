<?php

namespace App\Person\App\Resolver;

use App\Person\App\Query\PersonsQuery;
use App\Person\Domain\PersonRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonsResolver implements ResolverInterface, AliasedInterface
{
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function resolve(string $id = null): array
    {
        $query = new PersonsQuery($id);

        return $this->personRepository->findAll($query);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Persons',
        ];
    }
}
