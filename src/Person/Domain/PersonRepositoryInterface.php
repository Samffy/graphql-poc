<?php

namespace App\Person\Domain;

interface PersonRepositoryInterface
{
    /**$
     * @param string $id
     * @return Person|null
     */
    public function find(string $id): ?Person;
}
