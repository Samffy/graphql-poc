<?php

namespace App\Vehicle\App\Mutation;

use App\Common\App\Transformer\AppGlobalId;
use App\Common\Domain\MutationException;
use App\Common\Domain\ValidationException;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use GraphQL\Error\UserError;
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
     * @param string $id
     * @param string $manufacturer
     * @param string $model
     * @param int $seatsNumber
     * @return Car|\App\Vehicle\Domain\VehicleInterface|null
     * @throws ValidationException
     */
    public function createCar(string $id, string $manufacturer, string $model, int $seatsNumber)
    {
        if ($car = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Car [%s] already exist', AppGlobalId::toGlobalId('Car', $id)));

            return $car;
        }

        $car = new Car($id, $manufacturer, $model, $seatsNumber);

        $constraintViolations = $this->validator->validate($car);

        if ($constraintViolations->count()) {
            throw new ValidationException($constraintViolations, 'Car mutation is invalid');
        }

        return $this->vehicleRepository->save($car);
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
