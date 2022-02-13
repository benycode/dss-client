<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;

final class TrustAnchor
{   
    private string $countryCode;
    
    private string $trustServiceProvider;
    
    private string $trustServiceProviderRegistrationId;
    
    private string $trustServiceName;
    
    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }
    
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
    
    public function setTrustServiceProvider(string $trustServiceProvider): self
    {
        $this->trustServiceProvider = $trustServiceProvider;
        return $this;
    }
    
    public function getTrustServiceProvider(): string
    {
        return $this->trustServiceProvider;
    }
    
    public function setTrustServiceProviderRegistrationId(string $trustServiceProviderRegistrationId): self
    {
        $this->trustServiceProviderRegistrationId = $trustServiceProviderRegistrationId;
        return $this;
    }
    
    public function getTrustServiceProviderRegistrationId(): string
    {
        return $this->trustServiceProviderRegistrationId;
    }
    
    public function setTrustServiceName(string $trustServiceName): self
    {
        $this->trustServiceName = $trustServiceName;
        return $this;
    }
    
    public function getTrustServiceName(): string
    {
        return $this->trustServiceName;
    }
}
