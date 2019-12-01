<?php

namespace App\Person\App\Query;

class PersonsQuery
{
    private $personId;

    public function __construct(string $personId = null)
    {
        $this->personId = $personId;
    }

    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    public function hasPersonId(): bool
    {
        return $this->personId !== null;
    }
}
