<?php

namespace App\Vehicle\App\Mutation;

use App\Common\App\Transformer\AppGlobalId;
use App\Vehicle\Domain\Car;
use App\Vehicle\Domain\VehicleRepositoryInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class VehicleMutation implements MutationInterface, AliasedInterface
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
     * @param string $globalId
     * @return string
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function deleteVehicle(string $globalId): string
    {
        $id = AppGlobalId::getIdFromGlobalId($globalId);

        if (!$vehicle = $this->vehicleRepository->find($id)) {
            throw new UserError(sprintf('Vehicle [%s] not found', $globalId));
        }

        $this->vehicleRepository->delete($vehicle);

        return $globalId;
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'VehicleMutation',
        ];
    }
}
