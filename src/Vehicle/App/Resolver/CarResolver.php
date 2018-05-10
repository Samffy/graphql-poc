<?php

namespace App\Vehicle\App\Resolver;

use App\Vehicle\Domain\Car;
use App\Vehicle\Infra\Repository\CarRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class CarResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository) {
        $this->carRepository = $carRepository;
    }

    /**
     * @param string $id
     * @return Car|null
     */
    public function resolve(string $id): ?Car
    {
        return $this->carRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Car',
        ];
    }
}
