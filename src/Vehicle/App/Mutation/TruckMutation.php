<?php

namespace App\Vehicle\App\Mutation;

use App\Common\App\Transformer\AppGlobalId;
use App\Common\Domain\MutationException;
use App\Common\Domain\ValidationException;
use App\Vehicle\Domain\Truck;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TruckMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param VehicleRepositoryInterface $vehicleRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(VehicleRepositoryInterface $vehicleRepository, ValidatorInterface $validator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->validator = $validator;
    }

    /**
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $maximumLoad
     * @return Truck
     * @throws ValidationException
     */
    public function createTruck(string $id, string $manufacturer, string $model, int $maximumLoad): Truck
    {
        if ($truck = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Truck [%s] already exist', AppGlobalId::toGlobalId('Truck', $id)));

            return $truck;
        }

        $truck = new Truck($id, $manufacturer, $model, $maximumLoad);

        $constraintViolations = $this->validator->validate($truck);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Truck mutation is invalid');
        }

        return $this->vehicleRepository->save($truck);
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
