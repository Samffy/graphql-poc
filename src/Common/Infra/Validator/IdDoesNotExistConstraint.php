<?php

namespace App\Common\Infra\Validator;

use Symfony\Component\Validator\Constraint;

class IdDoesNotExistConstraint extends Constraint
{
    /**
     * @var string
     */
    public $message = '%className% [%id%] already exist';

    /**
     * @var string
     */
    public $fqcn;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getFqcn(): string
    {
        return $this->fqcn;
    }
}
