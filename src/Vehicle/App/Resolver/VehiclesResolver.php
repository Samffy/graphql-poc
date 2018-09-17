<?php

namespace App\Vehicle\App\Resolver;

use App\Person\Domain\Person;
use App\Vehicle\App\Query\VehiclesQuery;
use App\Vehicle\Infra\Repository\VehicleRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;

class VehiclesResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var VehicleRepository
     */
    private $vehicleRepository;

    /**
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param Argument $argument
     * @return Connection
     */
    public function resolve(Argument $argument): Connection
    {
        $query = VehiclesQuery::createFromArgument($argument);

        $paginator = new Paginator(function ($offset, $limit) use ($query) {
            if ($offset !== null && $limit !== null) {
                $query
                    ->setLimit($limit)
                    ->setOffset($offset)
                ;
            }

            return $this->vehicleRepository->findAll($query);
        });

        return $paginator->forward(
            new Argument([
                'first' => $argument->offsetGet('first'),
            ])
        );
    }

    /**
     * @param Person $person
     * @param string|null $id
     * @return array|null
     */
    public function resolveByPerson(Person $person, string $id = null): ?array
    {
        $query = new VehiclesQuery($person->getId(), $id);

        return $this->vehicleRepository->findAll($query);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Vehicles',
        ];
    }
}
