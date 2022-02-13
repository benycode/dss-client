<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion;

final class BasicBuildingBlock
{   
    private ?string $fc = null;
    
    private ?string $isc = null;
    
    private ?string $vci = null;
    
    private Xcv $xcv;
    
    private ?string $cv = null;
    
    private ?string $sav = null;
    
    private ?string $psv = null;
    
    private ?string $pcv = null;
    
    private ?string $vts = null;
    
    private ?string $certificateChain = null;
    
    private Conclusion $conclusion;
    
    private string $id;
    
    private string $type;
        
    public function setFc(?string $fc): self
    {
        $this->fc = $fc;
        return $this;
    }
    
    public function getFc(): ?string
    {
        return $this->fc;
    }
    
    public function setIsc(?string $isc): self
    {
        $this->isc = $isc;
        return $this;
    }
    
    public function getIsc(): ?string
    {
        return $this->isc;
    }
    
    public function setVci(?string $vci): self
    {
        $this->vci = $vci;
        return $this;
    }
    
    public function getVci(): ?string
    {
        return $this->vci;
    }
    
    public function setXcv(Xcv $xcv): self
    {
        $this->xcv = $xcv;
        return $this;
    }
    
    public function getXcv(): Xcv
    {
        return $this->xcv;
    }
    
    public function setCv(?string $cv): self
    {
        $this->cv = $cv;
        return $this;
    }
    
    public function getCv(): ?string
    {
        return $this->cv;
    }
    
    public function setSav(?string $sav): self
    {
        $this->sav = $sav;
        return $this;
    }
    
    public function getSav(): ?string
    {
        return $this->sav;
    }
    
    public function setPsv(?string $psv): self
    {
        $this->psv = $psv;
        return $this;
    }
    
    public function getPsv(): ?string
    {
        return $this->psv;
    }
    
    public function setPcv(?string $pcv): self
    {
        $this->pcv = $pcv;
        return $this;
    }
    
    public function getPcv(): ?string
    {
        return $this->pcv;
    }
    
    public function setVts(?string $vts): self
    {
        $this->vts = $vts;
        return $this;
    }
    
    public function getVts(): ?string
    {
        return $this->vts;
    }
    
    public function setCertificateChain(?string $certificateChain): self
    {
        $this->certificateChain = $certificateChain;
        return $this;
    }
    
    public function getCertificateChain(): ?string
    {
        return $this->certificateChain;
    }
    
    public function setConclusion(Conclusion $conclusion): self
    {
        $this->conclusion = $conclusion;
        return $this;
    }
    
    public function getConclusion(): Conclusion
    {
        return $this->conclusion;
    }
    
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): string
    {
        return $this->id;
    }
    
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
}
