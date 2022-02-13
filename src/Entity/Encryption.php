<?php

declare(strict_types=1);

namespace DSS\Entity;

final class Encryption
{
    private string $algorithm;

    public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
		return $this;
    }
	
	public function getAlgorithm(): string
    {
        return $this->algorithm;
    }
}
