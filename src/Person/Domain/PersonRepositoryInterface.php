<?php

namespace App\Person\Domain;

use App\Person\App\Query\PersonsQuery;

interface PersonRepositoryInterface
{
    public function find(string $id): ?Person;

    public function findAll(PersonsQuery $query): array;
}
