<?php

namespace App\Person\Infra\Repository;

use App\Common\Infra\Repository\DataRepository;
use App\Person\App\Query\PersonsQuery;
use App\Person\Domain\Person;
use App\Person\Domain\PersonRepositoryInterface;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @param string $id
     * @return Person
     */
    public function find(string $id): ?Person
    {
        if (array_key_exists($id, $this->getPersons())) {
            return $this->getPersons()[$id];
        }

        return null;
    }

    /**
     * @param PersonsQuery $query
     * @return array
     */
    public function findAll(PersonsQuery $query): array
    {
        if ($query->hasPersonId()) {
            if (array_key_exists($query->getPersonId(), DataRepository::getPersons())) {
                return [DataRepository::getPersons()[$query->getPersonId()]];
            } else {
                return [];
            }
        }

        return DataRepository::getPersons();
    }
}
