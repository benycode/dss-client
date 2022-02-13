<?php

declare(strict_types=1);

namespace DSS\HttpClient\Message;

final class FileResource
{
    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * The resource.
     *
     * @var string|resource|\Psr\Http\Message\StreamInterface
     */
    private $resource;

    /**
     * The options.
     *
     * @var array
     */
    private $options;

    public function __construct(string $name, $resource, array $options = [])
    {
        $this->name = $name;
        $this->resource = $resource;
        $this->options = $options;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the resource.
     *
     * @return string|resource|\Psr\Http\Message\StreamInterface
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
