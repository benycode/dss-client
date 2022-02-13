<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem;

final class Revocation
{	
	private ?string $productionDate = null;
	
	private ?string $revocationDate = null;
	
	private ?string $revocationReason = null;
		
    public function setProductionDate(?string $productionDate): self
    {
        $this->productionDate = $productionDate;
		return $this;
    }
	
	public function getProductionDate(): ?string
    {
        return $this->productionDate;
    }
	
	public function setRevocationDate(?string $revocationDate): self
    {
        $this->revocationDate = $revocationDate;
		return $this;
    }
	
	public function getRevocationDate(): ?string
    {
        return $this->revocationDate;
    }
	
	public function setRevocationReason(?string $revocationReason): self
    {
        $this->revocationReason = $revocationReason;
		return $this;
    }
	
	public function getRevocationReason(): ?string
    {
        return $this->revocationReason;
    }
}
