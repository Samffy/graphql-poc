<?php

namespace App\Common\Infra\Validator;

use Symfony\Component\Validator\Constraint;

class IdExistConstraint extends Constraint
{
    public $message = '%className% [%id%] not found';
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
