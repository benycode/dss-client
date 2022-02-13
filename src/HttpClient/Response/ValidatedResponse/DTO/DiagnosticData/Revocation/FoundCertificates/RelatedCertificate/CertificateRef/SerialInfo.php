<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef;

final class SerialInfo
{   
    private ?string $issuerName = null;
    
    private ?string $serialNumber = null;
    
    private ?string $ski = null;
    
    private ?string $current = null;
        
    public function setIssuerName(?string $issuerName): self
    {
        $this->issuerName = $issuerName;
        return $this;
    }
    
    public function getIssuerName(): ?string
    {
        return $this->issuerName;
    }
    
    public function setSerialNumber(?string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }
    
    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }
    
    public function setSki(?string $ski): self
    {
        $this->ski = $ski;
        return $this;
    }
    
    public function getSki(): ?string
    {
        return $this->ski;
    }
    
    public function setCurrent(?string $current): self
    {
        $this->current = $current;
        return $this;
    }
    
    public function getCurrent(): ?string
    {
        return $this->current;
    }
}
