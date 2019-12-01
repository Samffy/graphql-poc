<?php

namespace App\Common\Infra\Validator;

use Symfony\Component\Validator\Constraint;

class IdDoesNotExistConstraint extends Constraint
{
    public $message = '%className% [%id%] already exist';
    public $fqcn;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getFqcn(): string
    {
        return $this->fqcn;
    }
}
