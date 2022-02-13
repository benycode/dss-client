<?php

declare(strict_types=1);

namespace DSS\HttpClient\Plugin;

use DSS\Client;
use DSS\Exception\RuntimeException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Authentication implements Plugin
{
    private $header;

    public function __construct(string $method, string $token, string $password = null)
    {
        $this->header = self::buildAuthorizationHeader($method, $token, $password);
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $request = $request->withHeader('Authorization', $this->header);

        return $next($request);
    }

    private static function buildAuthorizationHeader(string $method, string $token, string $password = null): string
    {
        switch ($method) {
            case Client::AUTH_HTTP_PASSWORD:
                if (null === $password) {
                    throw new RuntimeException(\sprintf('Authentication method "%s" requires a password to be set.', $method));
                }

                return \sprintf('Basic %s', \base64_encode(\sprintf('%s:%s', $token, $password)));
            case Client::AUTH_OAUTH_TOKEN:
                return \sprintf('Bearer %s', $token);
            case Client::AUTH_JWT:
                return \sprintf('JWT %s', $token);
        }

        throw new RuntimeException(\sprintf('Authentication method "%s" not implemented.', $method));
    }
}
