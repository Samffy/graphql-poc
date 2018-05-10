<?php

namespace App\Person\App\Resolver;

use App\Person\App\Query\PersonsQuery;
use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PersonsResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository) {
        $this->personRepository = $personRepository;    }

    /**
     * @param string|null $id
     * @return array
     */
    public function resolve(string $id = null): array
    {
        $query = new PersonsQuery($id);

        return $this->personRepository->findAll($query);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Persons',
        ];
    }
}
