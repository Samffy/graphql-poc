<?php

namespace App\Person\Infra\Repository;

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
            if (array_key_exists($query->getPersonId(), $this->getPersons())) {
                return [$this->getPersons()[$query->getPersonId()]];
            } else {
                return [];
            }
        }

        return $this->getPersons();
    }

    /**
     * @return array
     */
    private function getPersons(): array
    {
        return [
            'duffy'  => new Person('duffy', 'Patrick Duffy', Person::TITLE_MR),
            'chuck'  => new Person('chuck', 'Chuck Norris', Person::TITLE_MR),
            'milano' => new Person('milano', 'Alyssa Milano', Person::TITLE_MRS),
        ];
    }
}
