<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport;

interface ConclusionError
{   
    public function setValue(string $value): self;
    public function getValue(): string;
    public function setKey(string $key): self;
    public function getKey(): string;
}
