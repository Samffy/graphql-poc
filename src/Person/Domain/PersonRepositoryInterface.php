<?php

namespace App\Person\Domain;

use App\Person\App\Query\PersonsQuery;

interface PersonRepositoryInterface
{
    /**$
     * @param string $id
     * @return Person|null
     */
    public function find(string $id): ?Person;

    /**
     * @param PersonsQuery $query
     * @return array
     */
    public function findAll(PersonsQuery $query): array;
}
