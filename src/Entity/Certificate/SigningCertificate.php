<?php

declare(strict_types=1);

namespace DSS\Entity\Certificate;

use DSS\Entity\Certificate;
use DSS\Entity\AbstractCertificate;

final class SigningCertificate implements Certificate
{
	private string $certificate;
	
	private ?array $chains = [];
	
	private bool $canBeExpired = false;
	
    public function setCertificate(string $certificate): Certificate
    {
        $this->certificate = $certificate;
		return $this;
    }

    public function getCertificate(): string
    {
        return $this->certificate;
    }
	
	public function appendChain(string $chain): Certificate
    {
        $this->chains[] = $chain;
		return $this;
    }
	
	public function getChains(): array
	{
		return $this->chains;
	}
	
	public function setCanBeExpired(bool $canBeExpired): Certificate
    {
        $this->canBeExpired = $canBeExpired;
		return $this;
    }

    public function getCanBeExpired(): bool
    {
        return $this->canBeExpired;
    }
}
