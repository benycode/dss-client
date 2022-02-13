<?php

declare(strict_types=1);

namespace DSS\HttpClient\Util;

use ValueError;

final class UriBuilder
{
    public static function build(string ...$parts): string
    {
        foreach ($parts as $index => $part) {
            if ('' === $part) {
                throw new ValueError(\sprintf('%s::buildUri(): Argument #%d ($parts) must non-empty', self::class, $index + 1));
            }

            $parts[$index] = \rawurlencode($part);
        }

        return self::appendPath(\implode('/', $parts));
    }

    public static function appendPath(string $uri): string
    {
        return \sprintf('/services/rest/%s', $uri);
    }
}
