<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion\Warning;

final class Conclusion
{   
    private string $indication;
    
    private ?string $subIndication = null;
    
    private array $errors = [];
    
    private array $warnings = [];

    private ?string $infos = null;
    
    public function setIndication(string $indication): self
    {
        $this->indication = $indication;
        return $this;
    }
    
    public function getIndication(): string
    {
        return $this->indication;
    }
    
    public function setSubIndication(?string $subIndication): self
    {
        $this->subIndication = $subIndication;
        return $this;
    }
    
    public function getSubIndication(): ?string
    {
        return $this->subIndication;
    }
    
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
    
    public function getErrors(): array
    {
        return $this->errors;
    }
    
    public function appendWarning(Warning $warning): self
    {
        $this->warnings[] = $warning;
        return $this;
    }
    
    public function getWarnings(): array
    {
        return $this->warnings;
    }
    
    public function setInfos(?string $infos): self
    {
        $this->infos = $infos;
        return $this;
    }
    
    public function getInfos(): ?string
    {
        return $this->infos;
    }
}
