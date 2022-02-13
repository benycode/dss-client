<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

final class CertificatePolicy
{   
    private string $value;
    
    private ?string $description = null;
    
    private ?string $cpsUrl = null;
        
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    public function setCpsUrl(?string $cpsUrl): self
    {
        $this->cpsUrl = $cpsUrl;
        return $this;
    }
    
    public function getCpsUrl(): ?string
    {
        return $this->cpsUrl;
    }
}
