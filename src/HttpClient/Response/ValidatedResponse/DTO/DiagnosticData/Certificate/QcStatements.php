<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcCompliance;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcSSCD;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\PdsLocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\QcType;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\QcStatements\SemanticsIdentifier;

final class QcStatements
{   
    private QcCompliance $qcCompliance;
    
    private ?string $qcEuLimitValue = null;
    
    private ?string $qcEuRetentionPeriod = null;
    
    private QcSSCD $qcSSCD;
    
    private array $pdsLocations = [];
    
    private array $qcTypes = [];
    
    private array $countryName = [];
    
    private ?string $pSD2QcInfo = null;
    
    private SemanticsIdentifier $semanticsIdentifier;
    
    public function setQcCompliance(QcCompliance $qcCompliance): self
    {
        $this->qcCompliance = $qcCompliance;
        return $this;
    }
    
    public function getQcCompliance(): QcCompliance
    {
        return $this->qcCompliance;
    }
    
    public function setQcEuLimitValue(?string $qcEuLimitValue): self
    {
        $this->qcEuLimitValue = $qcEuLimitValue;
        return $this;
    }
    
    public function getQcEuLimitValue(): ?string
    {
        return $this->qcEuLimitValue;
    }
    
    public function setQcEuRetentionPeriod(?string $qcEuRetentionPeriod): self
    {
        $this->qcEuRetentionPeriod = $qcEuRetentionPeriod;
        return $this;
    }
    
    public function getQcEuRetentionPeriod(): ?string
    {
        return $this->qcEuRetentionPeriod;
    }
    
    public function setQcSSCD(QcSSCD $qcSSCD): self
    {
        $this->qcSSCD = $qcSSCD;
        return $this;
    }
    
    public function getQcSSCD(): QcSSCD
    {
        return $this->qcSSCD;
    }
    
    public function appendPdsLocation(PdsLocation $pdsLocation): self
    {
        $this->pdsLocations[] = $pdsLocation;
        return $this;
    }
    
    public function setPdsLocations(array $pdsLocations): self
    {
        $this->pdsLocations = $pdsLocations;
        return $this;
    }
    
    public function getPdsLocations(): array
    {
        return $this->pdsLocations;
    }
    
    public function appendQcType(QcType $qcType): self
    {
        $this->qcTypes[] = $qcType;
        return $this;
    }
    
    public function setQcTypes(array $qcTypes): self
    {
        $this->qcTypes = $qcTypes;
        return $this;
    }
    
    public function getQcTypes(): array
    {
        return $this->qcTypes;
    }
    
    public function setCountryName(array $countryName): self
    {
        $this->countryName = $countryName;
        return $this;
    }
    
    public function getCountryName(): array
    {
        return $this->countryName;
    }
    
    public function setSemanticsIdentifier(SemanticsIdentifier $semanticsIdentifier): self
    {
        $this->semanticsIdentifier = $semanticsIdentifier;
        return $this;
    }
    
    public function getSemanticsIdentifier(): SemanticsIdentifier
    {
        return $this->semanticsIdentifier;
    }
    
    public function setPSD2QcInfo(?string $pSD2QcInfo): self
    {
        $this->pSD2QcInfo = $pSD2QcInfo;
        return $this;
    }
    
    public function getPSD2QcInfo(): ?string
    {
        return $this->pSD2QcInfo;
    }
}
