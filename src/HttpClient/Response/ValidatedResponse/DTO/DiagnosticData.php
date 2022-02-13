<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Revocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\TrustedList;
use Carbon\Carbon;

final class DiagnosticData
{	
	private ?string $documentName = null;
	
	private Carbon $validationDate;
	
	private ?string $containerInfo = null;
	
	private ?string $signature = null;
	
	private array $certificates;
	
	private array $revocations = [];
	
	private ?string $timestamp = null;
	
	private ?string $orphanTokens = null;
	
	private ?string $signerData = null;
	
	private array $trustedLists = [];
	
    public function setDocumentName(?string $documentName): self
    {
        $this->documentName = $documentName;
		return $this;
    }
	
	public function getDocumentName(): ?string
    {
        return $this->documentName;
    }
	
	public function setValidationDate(Carbon $validationDate): self
    {
        $this->validationDate = $validationDate;
		return $this;
    }
	
	public function getValidationDate(): Carbon
    {
        return $this->validationDate;
    }
	
	public function setContainerInfo(?string $containerInfo): self
    {
        $this->containerInfo = $containerInfo;
		return $this;
    }
	
	public function getContainerInfo(): ?string
    {
        return $this->containerInfo;
    }
	
	public function setSignature(?string $signature): self
    {
        $this->signature = $signature;
		return $this;
    }
	
	public function getSignature(): ?string
    {
        return $this->signature;
    }
	
	public function appendCertificate(Certificate $certificate): self
    {
        $this->certificates[] = $certificate;
		return $this;
    }
	
	public function getCertificates(): array
    {
        return $this->certificates;
    }
	
	public function setRevocations(array $revocations): self
    {
        $this->revocations = $revocations;
		return $this;
    }
    
    public function appendRevocation(Revocation $revocation): self
    {
        $this->revocations[] = $revocation;
        return $this;
    }
	
	public function getRevocations(): array
    {
        return $this->revocations;
    }
	
	public function setTimestamp(?string $timestamp): self
    {
        $this->timestamp = $timestamp;
		return $this;
    }
	
	public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }
	
	public function setOrphanTokens(?string $orphanTokens): self
    {
        $this->orphanTokens = $orphanTokens;
		return $this;
    }
	
	public function getOrphanTokens(): ?string
    {
        return $this->orphanTokens;
    }
	
	public function setSignerData(?string $signerData): self
    {
        $this->signerData = $signerData;
		return $this;
    }
	
	public function getSignerData(): ?string
    {
        return $this->signerData;
    }
	
	public function setTrustedLists(array $trustedLists): self
    {
        $this->trustedLists = $trustedLists;
		return $this;
    }
    
    public function appendTrustedList(TrustedList $trustedList): self
    {
        $this->trustedLists[] = $trustedList;
        return $this;
    }
	
	public function getTrustedLists(): array
    {
        return $this->trustedLists;
    }
}
