<?php

namespace App\Person\App\Query;

class PersonsQuery
{
    /**
     * @var null|string
     */
    private $personId;

    /**
     * @param string|null $personId
     */
    public function __construct(string $personId = null)
    {
        $this->personId = $personId;
    }

    /**
     * @return null|string
     */
    public function getPersonId(): ?string
    {
        return $this->personId;
    }

    /**
     * @return bool
     */
    public function hasPersonId(): bool
    {
        return $this->personId !== null;
    }
}
