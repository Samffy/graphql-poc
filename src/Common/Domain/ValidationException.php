<?php

namespace App\Common\Domain;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use GraphQL\Error\ClientAware;

class ValidationException extends \Exception implements ClientAware
{
    const DEFAULT_MESSAGE = 'The input object you try to submit is invalid';

    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * @param ConstraintViolationListInterface $violations
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(ConstraintViolationListInterface $violations, $message = self::DEFAULT_MESSAGE, $code = 0, \Throwable $previous = null)
    {
        $this->violations = $violations;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return 'Validation exception';
    }

    /**
     * @return bool
     */
    public function isClientSafe() :bool
    {
        return true;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations() :ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
