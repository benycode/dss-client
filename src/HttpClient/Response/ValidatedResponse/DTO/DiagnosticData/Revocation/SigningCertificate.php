<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation;

final class SigningCertificate
{   
    private ?string $publicKey = null;
    
    private string $certificate;
        
    public function setPublicKey(?string $publicKey): self
    {
        $this->publicKey = $publicKey;
        return $this;
    }
    
    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }
    
    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;
        return $this;
    }
    
    public function getCertificate(): string
    {
        return $this->certificate;
    }
}
