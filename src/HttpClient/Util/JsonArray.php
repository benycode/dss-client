<?php

declare(strict_types=1);

namespace DSS\HttpClient\Util;

use DSS\Exception\RuntimeException;

final class JsonArray
{
    public static function fixJson($json) {
        $maxIntLength = strlen((string) PHP_INT_MAX) - 1;
        return preg_replace('/:\s*(-?\d{'.$maxIntLength.',})/', ': "$1"', $json);
    }
    
    public static function decode(string $json): array
    {
        /** @var scalar|array|null */
        $data = \json_decode(self::fixJson($json), true);

        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new RuntimeException(\sprintf('json_decode error: %s', \json_last_error_msg()));
        }

        if (null === $data || !\is_array($data)) {
            throw new RuntimeException(\sprintf('json_decode error: Expected JSON of type array, %s given.', \get_debug_type($data)));
        }

        return $data;
    }

    public static function encode(array $value): string
    {
        $json = \json_encode($value);

        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new RuntimeException(\sprintf('json_encode error: %s', \json_last_error_msg()));
        }

        /** @var string */
        return $json;
    }
}
