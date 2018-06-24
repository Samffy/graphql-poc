<?php

namespace App\Common\App\Expression;

use App\Common\App\Transformer\AppGlobalId;
use Overblog\GraphQLBundle\ExpressionLanguage\ExpressionFunction;

final class IdFromGlobalId extends ExpressionFunction
{
    public function __construct($name = 'idFromGlobalId')
    {
        parent::__construct(
            $name,
            function ($globalId) {
                return sprintf(
                    '\%s::getIdFromGlobalId(%s)',
                    AppGlobalId::class,
                    $globalId
                );
            }
        );
    }
}
