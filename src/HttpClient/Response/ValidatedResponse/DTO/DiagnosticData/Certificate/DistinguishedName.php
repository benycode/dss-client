<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

interface DistinguishedName
{   
    public function setValue(string $value): self;
    public function getValue(): string;
    public function setFormat(string $format): self;
    public function getFormat(): string;
}
