<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

final class ChainItem
{   
    private string $certificate;
        
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
