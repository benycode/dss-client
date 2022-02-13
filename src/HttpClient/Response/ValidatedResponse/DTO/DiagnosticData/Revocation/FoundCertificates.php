<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\RelatedCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation\FoundCertificates\OrphanCertificate;

final class FoundCertificates
{   
    private array $relatedCertificates = [];
    
    private array $orphanCertificates = [];
        
    public function setRelatedCertificates(array $relatedCertificates): self
    {
        $this->relatedCertificates = $relatedCertificates;
        return $this;
    }
    
    public function appendRelatedCertificate(RelatedCertificate $relatedCertificate): self
    {
        $this->relatedCertificates[] = $relatedCertificate;
        return $this;
    }
    
    public function getRelatedCertificates(): array
    {
        return $this->relatedCertificates;
    }
    
    public function setOrphanCertificates(array $orphanCertificates): self
    {
        $this->orphanCertificates = $orphanCertificates;
        return $this;
    }
    
    public function appendOrphanCertificate(OrphanCertificate $orphanCertificate): self
    {
        $this->orphanCertificates[] = $orphanCertificate;
        return $this;
    }
    
    public function getOrphanCertificates(): array
    {
        return $this->orphanCertificates;
    }
}
