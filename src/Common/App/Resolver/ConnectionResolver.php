<?php

namespace App\Common\App\Resolver;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;

class ConnectionResolver implements ResolverInterface, AliasedInterface
{
    public function resolve(Connection $connection): int
    {
        return count($connection->edges);
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Connection',
        ];
    }
}
