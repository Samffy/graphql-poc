<?php

namespace App\Person\Domain;

use App\Animal\Domain\AnimalInterface;

class Person
{
    const TITLE_UNKNOWN = 0;
    const TITLE_MISS = 1;
    const TITLE_MRS = 2;
    const TITLE_MS = 3;
    const TITLE_MR = 4;

    private $id;
    private $name;
    private $title;
    private $birthDate;
    private $createdAt;
    private $pet;
    private $vehicles;

    public function __construct(
        string $id,
        string $name,
        int $title = self::TITLE_UNKNOWN,
        \DateTime $birthDate = null,
        ?AnimalInterface $pet = null,
        array $vehicles = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->birthDate = $birthDate;
        $this->createdAt = new \Datetime();
        $this->pet = $pet;
        $this->vehicles = $vehicles;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTitle(): int
    {
        return $this->title;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getPet(): ?AnimalInterface
    {
        return $this->pet;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }
}
