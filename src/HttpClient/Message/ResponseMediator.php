<?php

declare(strict_types=1);

namespace DSS\HttpClient\Message;

use DSS\Exception\RuntimeException;
use DSS\HttpClient\Util\JsonArray;
use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    public const CONTENT_TYPE_HEADER = 'Content-Type';

    public const JSON_CONTENT_TYPE = 'application/json';

    public static function getContent(ResponseInterface $response): array
    {
		if (500 === $response->getStatusCode()) {
            throw new RuntimeException((string) $response->getBody());
        }
		
        if (204 === $response->getStatusCode()) {
            return [];
        }

        $body = (string) $response->getBody();

        if ('' === $body) {
            return [];
        }

        if (0 !== \strpos($response->getHeaderLine(self::CONTENT_TYPE_HEADER), self::JSON_CONTENT_TYPE)) {
            throw new RuntimeException(\sprintf('The content type was not %s.', self::JSON_CONTENT_TYPE));
        }

        return JsonArray::decode($body);
    }

    public static function getErrorMessage(ResponseInterface $response): ?string
    {
        try {
            /** @var scalar|array */
            $error = self::getContent($response)['error'] ?? null;
        } catch (RuntimeException $e) {
            return null;
        }

        return \is_array($error) ? self::getMessageFromError($error) : null;
    }

    private static function getMessageFromError(array $error): ?string
    {
        /** @var scalar|array */
        $message = $error['message'] ?? '';

        if (!\is_string($message)) {
            return null;
        }

        $detail = self::getDetailAsString($error);

        if ('' !== $message) {
            return '' !== $detail ? \sprintf('%s: %s', $message, $detail) : $message;
        }

        if ('' !== $detail) {
            return $detail;
        }

        return null;
    }

    private static function getDetailAsString(array $error): string
    {
        /** @var string|array $detail */
        $detail = $error['detail'] ?? '';

        if ('' === $detail || [] === $detail) {
            return '';
        }

        return (string) \strtok(\is_string($detail) ? $detail : JsonArray::encode($detail), "\n");
    }
}
