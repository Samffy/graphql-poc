<?php

namespace App\Animal\Domain;

abstract class AnimalAbstract implements AnimalInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
     * @return string
     * @throws \ReflectionException
     */
    public function getBreed(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
