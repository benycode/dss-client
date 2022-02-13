<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\SignedResponse;

interface SignedObject
{
    public function setBytes(?string $bytes): self;
	
	public function setName(?string $name): self;
	
	public function setDigestAlgorithm(?string $digestAlgorithm): self;
	
	public function getBytes(): ?string;
	
	public function getName(): ?string;
	
	public function getDigestAlgorithm(): ?string;
}
