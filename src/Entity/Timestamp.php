<?php

declare(strict_types=1);

namespace DSS\Entity;

final class Timestamp
{
    private string $digestAlgorithm;
	
	private string $timestampContainerForm;

    public function setDigestAlgorithm(string $digestAlgorithm): self
    {
        $this->digestAlgorithm = $digestAlgorithm;
		return $this;
    }
	
	public function getDigestAlgorithm(): string
    {
        return $this->digestAlgorithm;
    }
	
	public function setTimestampContainerForm(string $timestampContainerForm): self
    {
        $this->timestampContainerForm = $timestampContainerForm;
		return $this;
    }
	
	public function getTimestampContainerForm(): string
    {
        return $this->timestampContainerForm;
    }
}
