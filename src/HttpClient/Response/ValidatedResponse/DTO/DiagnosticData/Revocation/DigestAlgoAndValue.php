<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation;

final class DigestAlgoAndValue
{   
    private string $digestMethod;
    
    private string $digestValue;
    
    private ?string $match = null;
        
    public function setDigestMethod(string $digestMethod): self
    {
        $this->digestMethod = $digestMethod;
        return $this;
    }
    
    public function getDigestMethod(): string
    {
        return $this->digestMethod;
    }
    
    public function setDigestValue(string $digestValue): self
    {
        $this->digestValue = $digestValue;
        return $this;
    }
    
    public function getDigestValue(): string
    {
        return $this->digestValue;
    }
    
    public function setMatch(?string $match): self
    {
        $this->match = $match;
        return $this;
    }
    
    public function getMatch(): ?string
    {
        return $this->match;
    }
}
