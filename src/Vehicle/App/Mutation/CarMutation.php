<?php

namespace App\Vehicle\App\Mutation;

use App\Common\App\Transformer\AppGlobalId;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CarMutation implements MutationInterface, AliasedInterface
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
     * @param int $seatsNumber
     * @return Car
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createCar(string $id, string $manufacturer, string $model, int $seatsNumber): Car
    {
        if ($car = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Car [%s] already exist', AppGlobalId::toGlobalId('Car', $id)));

            return $car;
        }

        return $this->vehicleRepository->save(
            new Car($id, $manufacturer, $model, $seatsNumber)
        );
    }

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $seatsNumber
     * @return Car
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateCar(string $id, string $manufacturer, string $model, int $seatsNumber): Car
    {
        if (!$car = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Car [%s] not found', AppGlobalId::toGlobalId('Car', $id)));
        }

        $car
            ->setManufacturer($manufacturer)
            ->setModel($model)
            ->setSeatsNumber($seatsNumber)
        ;

        return $this->vehicleRepository->save($car);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'CarMutation',
        ];
    }
}
