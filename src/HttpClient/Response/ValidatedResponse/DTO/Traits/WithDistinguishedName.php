<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\Traits;

trait WithDistinguishedName
{
    private string $value;
    
    private string $format;
        
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }
    
    public function getFormat(): string
    {
        return $this->format;
    }
}
