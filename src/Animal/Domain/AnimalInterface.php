<?php

namespace App\Animal\Domain;

interface AnimalInterface
{
    /**
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name);

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getBreed(): string;
}