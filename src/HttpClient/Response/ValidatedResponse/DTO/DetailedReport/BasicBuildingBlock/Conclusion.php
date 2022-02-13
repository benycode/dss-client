<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion\Warning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion\Error;

final class Conclusion
{   
    private string $indication;
    
    private ?string $subIndication = null;
    
    private array $errors = [];
    
    private array $warnings = [];

    private array $infos = [];
    
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
    
    public function appendError(Error $error): self
    {
        $this->errors[] = $error;
        return $this;
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
    
    public function setWarnings(array $warnings): self
    {
        $this->warnings = $warnings;
        return $this;
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
    
    public function setInfos(array $infos): self
    {
        $this->infos = $infos;
        return $this;
    }
    
    public function getInfos(): array
    {
        return $this->infos;
    }
}
