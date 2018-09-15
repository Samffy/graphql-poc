<?php

namespace App\Vehicle\App\Mutation;

use App\Common\Domain\ValidationException;
use App\Vehicle\App\Factory\VehicleFactory;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarMutation implements MutationInterface, AliasedInterface
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
     * @param Argument $argument
     * @return Car
     * @throws ValidationException
     */
    public function createCar(Argument $argument): Car
    {
        $carInput = VehicleFactory::createCarInput($argument);

        $constraintViolations = $this->validator->validate($carInput, null, ['create']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Car mutation is invalid');
        }

        return $this->vehicleRepository->save(
            VehicleFactory::createCar($carInput)
        );
    }

    /**
     * @param Argument $argument
     * @return Car
     * @throws ValidationException
     */
    public function updateCar(Argument $argument): Car
    {
        $carInput = VehicleFactory::createCarInput($argument);

        $constraintViolations = $this->validator->validate($carInput, null, ['update']);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Car mutation is invalid');
        }

        $car = $this->vehicleRepository->find($carInput->getId());

        $car
            ->setManufacturer($carInput->getManufacturer())
            ->setModel($carInput->getModel())
            ->setSeatsNumber($carInput->getSeatsNumber())
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
