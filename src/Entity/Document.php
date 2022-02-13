<?php

declare(strict_types=1);

namespace DSS\Entity;

final class Document
{
    private string $bytes;
	
	private string $name;

    public function setBytes(string $bytes): self
    {
        $this->bytes = $bytes;
		return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
		return $this;
    }
	
	public function getBytes(): string
    {
        return $this->bytes;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
