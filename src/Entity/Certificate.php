<?php

declare(strict_types=1);

namespace DSS\Entity;

interface Certificate
{
    public function setCertificate(string $name): Certificate;

    public function getCertificate(): string;
	
	public function appendChain(string $chain): Certificate;
	
	public function getChains(): array;
}
