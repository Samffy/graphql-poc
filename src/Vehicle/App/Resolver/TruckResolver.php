<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\Truck;
use App\Vehicle\Infra\Repository\TruckRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class TruckResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var TruckRepository
     */
    private $truckRepository;

    /**
     * @param TruckRepository $truckRepository
     */
    public function __construct(TruckRepository $truckRepository) {
        $this->truckRepository = $truckRepository;
    }

    /**
     * @param string $id
     * @return Truck|null
     */
    public function resolve(string $id): ?Truck
    {
        return $this->truckRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Truck',
        ];
    }
}
