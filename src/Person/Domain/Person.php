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

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var AnimalInterface|null
     */
    private $pet;

    /**
     * @param string $id
     * @param string $name
     * @param int $title
     * @param \DateTime|null $birthDate
     * @param AnimalInterface|null $pet
     */
    public function __construct(string $id, string $name, int $title = self::TITLE_UNKNOWN, \DateTime $birthDate = null, ?AnimalInterface $pet = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->birthDate = $birthDate;
        $this->createdAt = new \Datetime();
        $this->pet = $pet;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTitle(): int
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return AnimalInterface|null
     */
    public function getPet(): ?AnimalInterface
    {
        return $this->pet;
    }
}
