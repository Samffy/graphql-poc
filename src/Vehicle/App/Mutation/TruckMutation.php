<?php

namespace App\Vehicle\App\Mutation;

use App\Common\Domain\ValidationException;
use App\Vehicle\App\Factory\VehicleFactory;
use App\Vehicle\Domain\Truck;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TruckMutation implements MutationInterface, AliasedInterface
{
    private $vehicleRepository;
    private $validator;

    public function __construct(VehicleRepositoryInterface $vehicleRepository, ValidatorInterface $validator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->validator = $validator;
    }

    /**
     * @throws ValidationException
     */
    public function createTruck(Argument $argument): Truck
    {
        $truckInput = VehicleFactory::createTruckInput($argument);

        $constraintViolations = $this->validator->validate($truckInput, null, ['create']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Truck mutation is invalid');
        }

        return $this->vehicleRepository->save(
            VehicleFactory::createTruck($truckInput)
        );
    }

    /**
     * @throws ValidationException
     */
    public function updateTruck(Argument $argument): Truck
    {
        $truckInput = VehicleFactory::createTruckInput($argument);

        $constraintViolations = $this->validator->validate($truckInput, null, ['update']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Truck mutation is invalid');
        }

        $truck = $this->vehicleRepository->find($truckInput->getId());

        $truck
            ->setManufacturer($truckInput->getManufacturer())
            ->setModel($truckInput->getModel())
            ->setMaximumLoad($truckInput->getMaximumLoad())
        ;

        return $this->vehicleRepository->save($truck);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'TruckMutation',
        ];
    }
}
