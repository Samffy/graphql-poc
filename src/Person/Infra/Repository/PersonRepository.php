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
            'duffy'  => new Person('duffy', 'Patrick Duffy', Person::TITLE_MR, new \DateTime('1949-03-17 00:00:00')),
            'chuck'  => new Person('chuck', 'Chuck Norris', Person::TITLE_MR, new \DateTime('1940-03-10 00:00:00')),
            'milano' => new Person('milano', 'Alyssa Milano', Person::TITLE_MRS, new \DateTime('1972-12-19 00:00:00')),
        ];
    }
}
