<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements;

final class PdsLocation
{   
    private string $value;
    
    private string $lang;
        
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setLang(string $lang): self
    {
        $this->lang = $lang;
        return $this;
    }
    
    public function getLang(): string
    {
        return $this->lang;
    }
}
