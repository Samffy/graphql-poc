<?php

namespace App\Common\App\Transformer;

use Overblog\GraphQLBundle\Relay\Node\GlobalId;

class AppGlobalId extends GlobalId
{
    /**
     * @param $globalId
     * @return int|null
     */
    public static function getIdFromGlobalId(?string $globalId): ?string
    {
        $decodedGlobalId = parent::fromGlobalId($globalId);

        if (!$decodedGlobalId['id']) {
            return null;
        }

        return $decodedGlobalId['id'];
    }

    /**
     * @param $globalId
     * @return string|null
     */
    public static function getTypeFromGlobalId(?string $globalId): ?string
    {
        $decodedGlobalId = parent::fromGlobalId($globalId);

        if (!$decodedGlobalId['type']) {
            return null;
        }

        return $decodedGlobalId['type'];
    }
}
