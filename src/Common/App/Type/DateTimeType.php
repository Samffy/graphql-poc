<?php

namespace App\Common\App\Type;

use GraphQL\Language\AST\Node;

class DateTimeType
{
    /**
     * @param \DateTime $value
     *
     * @return string
     */
    public static function serialize(\DateTime $value)
    {
        return $value->format('c');
    }

    /**
     * @param string $value
     *
     * @return \Datetime
     */
    public static function parseValue($value)
    {
        return new \DateTime($value);
    }

    /**
     * @param Node $valueNode
     *
     * @return string
     */
    public static function parseLiteral($valueNode)
    {
        return new \DateTime($valueNode->value);
    }
}
