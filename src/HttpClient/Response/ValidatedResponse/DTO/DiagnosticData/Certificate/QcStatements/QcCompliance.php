<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements;

final class QcCompliance
{   
    private bool $present;
        
    public function setPresent(bool $present): self
    {
        $this->present = $present;
        return $this;
    }
    
    public function getPresent(): bool
    {
        return $this->present;
    }
}
