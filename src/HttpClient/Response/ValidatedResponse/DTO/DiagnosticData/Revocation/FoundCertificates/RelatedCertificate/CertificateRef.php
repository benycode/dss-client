<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef\DigestAlgoAndValue;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef\SerialInfo;

final class CertificateRef
{   
    private ?string $origin = null;
    
    private ?string $issuerSerial = null;
    
    private ?DigestAlgoAndValue $digestAlgoAndValue = null;
    
    private ?SerialInfo $serialInfo = null;
        
    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;
        return $this;
    }
   
    public function getOrigin(): ?string
    {
        return $this->origin;
    }
    
    public function setIssuerSerial(?string $issuerSerial): self
    {
        $this->issuerSerial = $issuerSerial;
        return $this;
    }
   
    public function getIssuerSerial(): ?array
    {
        return $this->issuerSerial;
    }
    
    public function setDigestAlgoAndValue(?DigestAlgoAndValue $digestAlgoAndValue): self
    {
        $this->digestAlgoAndValue = $digestAlgoAndValue;
        return $this;
    }
   
    public function getDigestAlgoAndValue(): ?DigestAlgoAndValue
    {
        return $this->digestAlgoAndValue;
    }
    
    public function setSerialInfo(?SerialInfo $serialInfo): self
    {
        $this->serialInfo = $serialInfo;
        return $this;
    }
   
    public function getSerialInfo(): ?SerialInfo
    {
        return $this->serialInfo;
    }
 
}
