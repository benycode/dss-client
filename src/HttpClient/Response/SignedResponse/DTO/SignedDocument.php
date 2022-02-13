<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\SignedResponse\DTO;

use DSS\HttpClient\Response\SignedResponse\SignedObject;

final class SignedDocument implements SignedObject
{	
	private ?string $bytes = null;
	
	private ?string $name = null;
	
	private ?string $digestAlgorithm = null;

    public function setBytes(?string $bytes): self
    {
        $this->bytes = $bytes;
		return $this;
    }
	
    public function setName(?string $name): self
    {
        $this->name = $name;
		return $this;
    }
	
	public function setDigestAlgorithm(?string $digestAlgorithm): self
    {
        $this->digestAlgorithm = $digestAlgorithm;
		return $this;
    }
	
	public function getBytes(): ?string
    {
        return $this->bytes;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
	
	public function getDigestAlgorithm(): ?string
    {
        return $this->digestAlgorithm;
    }
}
