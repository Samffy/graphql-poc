<?php

namespace App\Animal\Domain;

abstract class AnimalAbstract implements AnimalInterface
{
    private $id;
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws \ReflectionException
     */
    public function getBreed(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
