<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate\CertificateRef;

final class RelatedCertificate
{   
    private ?array $origin = null;
    
    private ?array $certificateRefs = null;
    
    private ?string $certificate = null;
        
    public function setOrigin(array $origin): self
    {
        $this->origin = $origin;
        return $this;
    }
   
    public function getOrigin(): ?array
    {
        return $this->origin;
    }
    
    public function setCertificateRefs(?array $certificateRefs): self
    {
        $this->certificateRefs = $certificateRefs;
        return $this;
    }
    
    public function appendCertificateRef(?CertificateRef $certificateRef): self
    {
        $this->certificateRefs[] = $certificateRef;
        return $this;
    }
   
    public function getCertificateRefs(): ?array
    {
        return $this->certificateRefs;
    }
    
    public function setCertificate(?string $certificate): self
    {
        $this->certificate = $certificate;
        return $this;
    }
   
    public function getCertificate(): ?string
    {
        return $this->certificate;
    }
}
