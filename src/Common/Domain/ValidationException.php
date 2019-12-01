<?php

namespace App\Common\Domain;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use GraphQL\Error\ClientAware;

class ValidationException extends \Exception implements ClientAware
{
    const DEFAULT_MESSAGE = 'The input object you try to submit is invalid';

    private $violations;

    public function __construct(ConstraintViolationListInterface $violations, $message = self::DEFAULT_MESSAGE, $code = 0, \Throwable $previous = null)
    {
        $this->violations = $violations;

        parent::__construct($message, $code, $previous);
    }

    public function getCategory(): string
    {
        return 'Validation exception';
    }

    public function isClientSafe() :bool
    {
        return true;
    }

    public function getViolations() :ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
