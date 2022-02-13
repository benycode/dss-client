<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport;

use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Subject;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\Revocation;
use DSS\HttpClient\Response\ValidatedResponse\DTO\SimpleCertificateReport\ChainItem\TrustAnchor;
use Carbon\Carbon;

final class ChainItem
{	
	private string $id;
	
	private Subject $subject;
	
	private ?string $issuerId = null;
	
	private Carbon $notAfter;
	
	private Carbon $NotBefore;
	
	private array $keyUsage = [];
	
	private ?array $extendedKeyUsage = null;
	
	private ?array $ocspUrl = null;
	
	private ?array $crlUrl = null;
	
	private ?array $aiaUrl = null;
	
	private ?array $cpsUrl = null;
	
	private ?string $qualificationAtIssuance = null;
	
	private ?string $qualificationAtValidation = null;
	
	private Revocation $revocation;
	
	private ?array $trustAnchors = null;
	
	private string $indication;
	
	private ?string $subIndication = null;
		
    public function setId(string $id): self
    {
        $this->id = $id;
		return $this;
    }
	
	public function getId(): string
    {
        return $this->id;
    }
	
	public function setSubject(Subject $subject): self
    {
        $this->subject = $subject;
		return $this;
    }
	
	public function getSubject(): Subject
    {
        return $this->subject;
    }
	
	public function setIssuerId(?string $issuerId): self
    {
        $this->issuerId = $issuerId;
		return $this;
    }
	
	public function getIssuerId(): ?string
    {
        return $this->issuerId;
    }
	
	public function setNotAfter(Carbon $notAfter): self
    {
        $this->notAfter = $notAfter;
		return $this;
    }
	
	public function getNotAfter(): Carbon
    {
        return $this->notAfter;
    }
	
	public function setNotBefore(Carbon $notBefore): self
    {
        $this->notBefore = $notBefore;
		return $this;
    }
	
	public function getNotBefore(): Carbon
    {
        return $this->notBefore;
    }
	
	public function setKeyUsage(array $keyUsage): self
    {
        $this->keyUsage = $keyUsage;
		return $this;
    }
	
	public function getKeyUsage(): array
    {
        return $this->keyUsage;
    }
	
	public function setExtendedKeyUsage(?array $extendedKeyUsage): self
    {
        $this->extendedKeyUsage = $extendedKeyUsage;
		return $this;
    }
	
	public function getExtendedKeyUsage(): ?array
    {
        return $this->extendedKeyUsage;
    }
	
	public function setOcspUrl(?array $ocspUrl): self
    {
        $this->ocspUrl = $ocspUrl;
		return $this;
    }
	
	public function getOcspUrl(): ?array
    {
        return $this->ocspUrl;
    }
	
	public function setCrlUrl(?array $crlUrl): self
    {
        $this->crlUrl = $crlUrl;
		return $this;
    }
	
	public function getCrlUrl(): ?array
    {
        return $this->crlUrl;
    }
	
	public function setAiaUrl(?array $aiaUrl): self
    {
        $this->aiaUrl = $aiaUrl;
		return $this;
    }
	
	public function getAiaUrl(): ?array
    {
        return $this->aiaUrl;
    }
	
	public function setCpsUrl(?array $cpsUrl): self
    {
        $this->cpsUrl = $cpsUrl;
		return $this;
    }
	
	public function getCpsUrl(): ?array
    {
        return $this->cpsUrl;
    }
	
	public function setPdsUrl(?array $pdsUrl): self
    {
        $this->pdsUrl = $pdsUrl;
		return $this;
    }
	
	public function getPdsUrl(): ?array
    {
        return $this->pdsUrl;
    }
	
	public function setQualificationAtIssuance(?string $qualificationAtIssuance): self
    {
        $this->qualificationAtIssuance = $qualificationAtIssuance;
		return $this;
    }
	
	public function getQualificationAtIssuance(): ?string
    {
        return $this->qualificationAtIssuance;
    }
	
	public function setQualificationAtValidation(?string $qualificationAtValidation): self
    {
        $this->qualificationAtValidation = $qualificationAtValidation;
		return $this;
    }
	
	public function getQualificationAtValidation(): ?string
    {
        return $this->qualificationAtValidation;
    }
	
	public function setRevocation(Revocation $revocation): self
    {
        $this->revocation = $revocation;
		return $this;
    }
	
	public function getRevocation(): Revocation
    {
        return $this->revocation;
    }
	
	public function setTrustAnchors(?array $trustAnchors): self
    {
        $this->trustAnchors = $trustAnchors;
		return $this;
    }
    
    public function appendTrustAnchor(TrustAnchor $trustAnchor): self
    {
        $this->trustAnchors[] = $trustAnchor;
        return $this;
    }
	
	public function getTrustAnchors(): ?array
    {
        return $this->trustAnchors;
    }
	
	public function setIndication(string $indication): self
    {
        $this->indication = $indication;
		return $this;
    }
	
	public function getIndication(): string
    {
        return $this->indication;
    }
	
	public function setSubIndication(?string $subIndication): self
    {
        $this->subIndication = $subIndication;
		return $this;
    }
	
	public function getSubIndication(): ?string
    {
        return $this->subIndication;
    }
}
