<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits;

trait WithConclusionWarning
{
    private string $value;
    
    private string $key;
        
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }
    
    public function getKey(): string
    {
        return $this->key;
    }
}
