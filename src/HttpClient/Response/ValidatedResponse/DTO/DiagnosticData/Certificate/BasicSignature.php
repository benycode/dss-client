<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

final class BasicSignature
{	
	private string $encryptionAlgoUsedToSignThisToken;
	
	private string $keyLengthUsedToSignThisToken;
	
	private string $digestAlgoUsedToSignThisToken;
	
	private ?string $maskGenerationFunctionUsedToSignThisToken = null;
	
	private ?bool $signatureIntact = null;
	
	private ?bool $signatureValid = null;
		
    public function setEncryptionAlgoUsedToSignThisToken(string $encryptionAlgoUsedToSignThisToken): self
    {
        $this->encryptionAlgoUsedToSignThisToken = $encryptionAlgoUsedToSignThisToken;
		return $this;
    }
	
	public function getEncryptionAlgoUsedToSignThisToken(): string
    {
        return $this->encryptionAlgoUsedToSignThisToken;
    }
	
	public function setKeyLengthUsedToSignThisToken(string $keyLengthUsedToSignThisToken): self
    {
        $this->keyLengthUsedToSignThisToken = $keyLengthUsedToSignThisToken;
		return $this;
    }
	
	public function getKeyLengthUsedToSignThisToken(): string
    {
        return $this->keyLengthUsedToSignThisToken;
    }
	
	public function setDigestAlgoUsedToSignThisToken(?string $digestAlgoUsedToSignThisToken): self
    {
        $this->digestAlgoUsedToSignThisToken = $digestAlgoUsedToSignThisToken;
		return $this;
    }
	
	public function getDigestAlgoUsedToSignThisToken(): ?string
    {
        return $this->digestAlgoUsedToSignThisToken;
    }
	
	public function setMaskGenerationFunctionUsedToSignThisToken(?string $maskGenerationFunctionUsedToSignThisToken): self
    {
        $this->maskGenerationFunctionUsedToSignThisToken = $maskGenerationFunctionUsedToSignThisToken;
		return $this;
    }
	
	public function getMaskGenerationFunctionUsedToSignThisToken(): ?string
    {
        return $this->maskGenerationFunctionUsedToSignThisToken;
    }
	
	public function setSignatureIntact(bool $signatureIntact): self
    {
        $this->signatureIntact = $signatureIntact;
		return $this;
    }
	
	public function getSignatureIntact(): bool
    {
        return $this->signatureIntact;
    }
	
	public function setSignatureValid(bool $signatureValid): self
    {
        $this->signatureValid = $signatureValid;
		return $this;
    }
	
	public function getSignatureValid(): bool
    {
        return $this->signatureValid;
    }
}
