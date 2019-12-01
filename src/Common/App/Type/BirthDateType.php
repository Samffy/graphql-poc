<?php

namespace App\Common\App\Type;

use GraphQL\Language\AST\Node;

class BirthDateType
{
    public static function serialize(\DateTime $value): string
    {
        return $value->format('Y-m-d');
    }

    public static function parseValue(string $value): \Datetime
    {
        return new \DateTime($value);
    }

    public static function parseLiteral(Node $valueNode): string
    {
        return new \DateTime($valueNode->value);
    }
}
