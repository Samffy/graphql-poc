<?php

namespace App\Vehicle\App\Mutation;

use App\Common\App\Transformer\AppGlobalId;
use App\Vehicle\Domain\Truck;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class TruckMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;

    /**
     * @param VehicleRepositoryInterface $vehicleRepository
     */
    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $maximumLoad
     * @return Truck
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createTruck(string $id, string $manufacturer, string $model, int $maximumLoad): Truck
    {
        if ($truck = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Truck [%s] already exist', AppGlobalId::toGlobalId('Truck', $id)));

            return $truck;
        }

        return $this->vehicleRepository->save(
            new Truck($id, $manufacturer, $model, $maximumLoad)
        );
    }

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $maximumLoad
     * @return Truck
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateTruck(string $id, string $manufacturer, string $model, int $maximumLoad): Truck
    {
        if (!$truck = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Truck [%s] not found', AppGlobalId::toGlobalId('Truck', $id)));
        }

        $truck
            ->setManufacturer($manufacturer)
            ->setModel($model)
            ->setMaximumLoad($maximumLoad)
        ;

        return $this->vehicleRepository->save($truck);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'TruckMutation',
        ];
    }
}
