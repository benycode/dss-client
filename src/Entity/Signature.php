<?php

declare(strict_types=1);

namespace DSS\Entity;

final class Signature
{
    private string $algorithm;
	
	private ?string $value = null;
	
	private string $signatureLevel;
	
	private string $signaturePackaging;
	
	private int $signingDate;

    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
		return $this;
    }
	
	public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;
		return $this;
    }
	
	public function getValue(): ?string
    {
        return $this->value;
    }
	
	public function setSignatureLevel(string $signatureLevel): self
    {
        $this->signatureLevel = $signatureLevel;
		return $this;
    }
	
	public function getSignatureLevel(): string
    {
        return $this->signatureLevel;
    }
	
	public function setSignaturePackaging(string $signaturePackaging): self
    {
        $this->signaturePackaging = $signaturePackaging;
		return $this;
    }
	
	public function getSignaturePackaging(): string
    {
        return $this->signaturePackaging;
    }
	
	public function setSigningDate(int $signingDate): self
    {
        $this->signingDate = $signingDate;
		return $this;
    }
	
	public function getSigningDate(): int
    {
        return $this->signingDate;
    }
}
