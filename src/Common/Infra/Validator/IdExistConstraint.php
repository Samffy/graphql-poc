<?php

namespace App\Common\Infra\Validator;

use Symfony\Component\Validator\Constraint;

class IdExistConstraint extends Constraint
{
    /**
     * @var string
     */
    public $message = '%className% [%id%] not found';

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
