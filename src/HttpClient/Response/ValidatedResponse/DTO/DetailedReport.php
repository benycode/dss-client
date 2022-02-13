<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock;

final class DetailedReport
{	
	private SignatureOrTimestampOrCertificate $signatureOrTimestampOrCertificate;
    
    private array $basicBuildingBlocks = [];
    
    private array $tLAnalysis = [];
    
    private ?string $semantic = null;
    
    private ?string $validationTime = null;
    
    public function setSignatureOrTimestampOrCertificate(SignatureOrTimestampOrCertificate $signatureOrTimestampOrCertificate): self
    {
        $this->signatureOrTimestampOrCertificate = $signatureOrTimestampOrCertificate;
		return $this;
    }
	
	public function getSignatureOrTimestampOrCertificate(): SignatureOrTimestampOrCertificate
    {
        return $this->signatureOrTimestampOrCertificate;
    }
         
    public function appendBasicBuildingBlock(BasicBuildingBlock $basicBuildingBlocks): self
    {
        $this->basicBuildingBlocks[] = $basicBuildingBlocks;
        return $this;
    }
    
    public function getBasicBuildingBlocks(): array
    {
        return $this->basicBuildingBlocks;
    }
    
        public function setTLAnalysis(array $tLAnalysis): self
    {
        $this->tLAnalysis = $tLAnalysis;
        return $this;
    }
    
    public function getTLAnalysis(): array
    {
        return $this->tLAnalysis;
    }
    
    public function setSemantic(?string $semantic): self
    {
        $this->semantic = $semantic;
        return $this;
    }
    
    public function getSemantic(): ?string
    {
        return $this->semantic;
    }
    
    public function setValidationTime(?string $validationTime): self
    {
        $this->validationTime = $validationTime;
        return $this;
    }
    
    public function getValidationTime(): ?string
    {
        return $this->validationTime;
    }
}
