<?php

namespace App\Animal\Domain;

interface AnimalInterface
{
    public function getId(): string;

    public function getName(): string;

    public function getBreed(): string;
}
