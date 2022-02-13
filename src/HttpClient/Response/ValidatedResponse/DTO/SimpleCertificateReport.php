<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO;

use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;
use Carbon\Carbon;

final class SimpleCertificateReport
{   
    private array $chainItem = [];
    
    private Carbon $validationTime;
        
    public function appendChainItem(ChainItem $chainItem): self
    {
        $this->chainItem[] = $chainItem;
        return $this;
    }
    
    public function getChainItem(): array
    {
        return $this->chainItem;
    }
    
    public function setValidationTime(Carbon $validationTime): self
    {
        $this->validationTime = $validationTime;
        return $this;
    }
    
    public function getValidationTime(): Carbon
    {
        return $this->validationTime;
    }
}
