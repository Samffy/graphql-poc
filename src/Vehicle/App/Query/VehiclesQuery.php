<?php

namespace App\Vehicle\App\Query;

use App\Common\App\Transformer\AppGlobalId;
use Overblog\GraphQLBundle\Definition\Argument;

class VehiclesQuery
{
    /**
     * @var string
     */
    private $personId;

    /**
     * @var string
     */
    private $vehicleId;

    /**
     * @var string
     */
    private $after;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * @param string|null $personId
     * @param string|null $vehicleId
     * @param string|null $after
     * @param int|null $offset
     * @param int|null $limit
     */
    public function __construct(string $personId = null, string $vehicleId = null, string $after = null, int $offset = null, int $limit = null)
    {
        $this->personId = $personId;
        $this->vehicleId = $vehicleId;
        $this->after = $after;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return null|string
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    /**
     * @return bool
     */
    public function hasPersonId(): bool
    {
        return $this->personId !== null;
    }

    /**
     * @return null|string
     */
    public function getVehicleId(): ?string
    {
        return $this->vehicleId;
    }

    /**
     * @return bool
     */
    public function hasVehicleId(): bool
    {
        return $this->vehicleId !== null;
    }

    /**
     * @return bool
     */
    public function hasAfter(): bool
    {
        return $this->after !== null;
    }

    /**
     * @return string
     */
    public function getAfter(): string
    {
        return $this->after;
    }

    /**
     * @return bool
     */
    public function hasOffset(): bool
    {
        return $this->offset !== null;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return VehiclesQuery
     */
    public function setOffset(int $offset): VehiclesQuery
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasLimit(): bool
    {
        return $this->limit !== null;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return VehiclesQuery
     */
    public function setLimit(int $limit): VehiclesQuery
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param Argument $argument
     * @return VehiclesQuery
     */
    public static function createFromArgument(Argument $argument): VehiclesQuery
    {
        return new self(
            ($argument->offsetGet('owner'))? AppGlobalId::getIdFromGlobalId($argument->offsetGet('owner')) : null,
            ($argument->offsetGet('id'))? AppGlobalId::getIdFromGlobalId($argument->offsetGet('id')) : null,
            ($argument->offsetGet('after'))? AppGlobalId::getIdFromGlobalId($argument->offsetGet('after')) : null
        );
    }
}
