<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

final class ExtendedKeyUsagesOid
{   
    private string $value;
    
    private string $description;
        
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
}
