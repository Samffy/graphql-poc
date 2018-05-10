<?php

namespace App\Person\Infra\Repository;

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
     * @return array
     */
    private function getPersons(): array
    {
        return [
            'duffy'  => new Person('duffy', 'Patrick Duffy'),
            'chuck'  => new Person('chuck', 'Chuck Norris'),
            'milano' => new Person('milano', 'Alyssa Milano'),
        ];
    }
}
