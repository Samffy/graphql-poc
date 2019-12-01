<?php

namespace App\Common\App\Formatter;

use App\Common\Domain\ValidationException;
use Overblog\GraphQLBundle\Event\ErrorFormattingEvent;

class ValidationExceptionFormatter
{
    /**
     * @param ErrorFormattingEvent $event
     */
    public function onErrorFormatting(ErrorFormattingEvent $event) :void
    {
        $error = $event->getError()->getPrevious();

        if ($error instanceof ValidationException) {
            $errors = [];

            $violations = $error->getViolations();
            foreach ($violations as $violation) {
                $errors[] = [
                    'name' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }

            $formattedError = $event->getFormattedError();
            $formattedError->offsetSet('fields', $errors);
        }
    }
}
