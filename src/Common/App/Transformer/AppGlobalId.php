<?php

namespace App\Common\App\Transformer;

use Overblog\GraphQLBundle\Relay\Node\GlobalId;

class AppGlobalId extends GlobalId
{
    public static function getIdFromGlobalId(?string $globalId): ?string
    {
        $decodedGlobalId = parent::fromGlobalId($globalId);

        if (!$decodedGlobalId['id']) {
            return null;
        }

        return $decodedGlobalId['id'];
    }

    public static function getTypeFromGlobalId(?string $globalId): ?string
    {
        $decodedGlobalId = parent::fromGlobalId($globalId);

        if (!$decodedGlobalId['type']) {
            return null;
        }

        return $decodedGlobalId['type'];
    }
}
