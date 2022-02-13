<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData;

use Carbon\Carbon;

final class TrustedList
{   
    private ?string $id = null;
    
    private ?string $countryCode = null;
    
    private ?string $url = null;
    
    private ?int $sequenceNumber = null;
    
    private ?int $version = null;
    
    private ?Carbon $lastLoading = null;
    
    private ?Carbon $issueDate = null;
    
    private ?Carbon $nextUpdate = null;
    
    private ?bool $wellSigned = null;
    
    private ?bool $lOTL = null;
    
    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): ?string
    {
        return $this->id;
    }
    
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }
    
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }
    
    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }
    
    public function getUrl(): ?string
    {
        return $this->url;
    }
    
    public function setSequenceNumber(?int $sequenceNumber): self
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }
    
    public function getSequenceNumber(): ?int
    {
        return $this->sequenceNumber;
    }
    
    public function setVersion(?int $version): self
    {
        $this->version = $version;
        return $this;
    }
    
    public function getVersion(): ?int
    {
        return $this->version;
    }
    
    public function setLastLoading(?Carbon $lastLoading): self
    {
        $this->lastLoading = $lastLoading;
        return $this;
    }
    
    public function getLastLoading(): ?Carbon
    {
        return $this->lastLoading;
    }
    
    public function setIssueDate(?Carbon $issueDate): self
    {
        $this->issueDate = $issueDate;
        return $this;
    }
    
    public function getIssueDate(): ?Carbon
    {
        return $this->issueDate;
    }
    
    public function setNextUpdate(?Carbon $nextUpdate): self
    {
        $this->nextUpdate = $nextUpdate;
        return $this;
    }
    
    public function getNextUpdate(): ?Carbon
    {
        return $this->nextUpdate;
    }
    
    public function setWellSigned(?bool $wellSigned): self
    {
        $this->wellSigned = $wellSigned;
        return $this;
    }
    
    public function getWellSigned(): ?bool
    {
        return $this->wellSigned;
    }
    
    public function setLOTL(?bool $lOTL): self
    {
        $this->lOTL = $lOTL;
        return $this;
    }
    
    public function getLOTL(): ?bool
    {
        return $this->lOTL;
    }
}
