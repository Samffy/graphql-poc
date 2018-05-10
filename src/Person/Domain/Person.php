<?php

namespace App\Person\Domain;

class Person
{
    const TITLE_UNKNOWN = 0;
    const TITLE_MISS = 1;
    const TITLE_MRS = 2;
    const TITLE_MS = 3;
    const TITLE_MR = 4;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $title;

    /**
     * @param string $id
     * @param string $name
     * @param int $title
     */
    public function __construct(string $id, string $name, int $title = self::TITLE_UNKNOWN)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTitle(): int
    {
        return $this->title;
    }
}
