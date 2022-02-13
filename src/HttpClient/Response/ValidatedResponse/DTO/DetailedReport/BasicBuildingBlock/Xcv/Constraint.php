<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint\Name;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint\Error;

final class Constraint
{   
    private Name $name;
    
    private string $status;
    
    private ?Error $error = null;
    
    private ?string $warning;
    
    private ?string $info = null;
    
    private ?string $additionalInfo = null;
    
    private ?string $id = null;
    
    private ?string $blockType = null;
        
    public function setName(Name $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    public function getName(): Name
    {
        return $this->name;
    }
    
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function setError(?Error $error): self
    {
        $this->error = $error;
        return $this;
    }
    
    public function getError(): ?Error
    {
        return $this->error;
    }
    
    public function setWarning(?string $warning): self
    {
        $this->warning = $warning;
        return $this;
    }
    
    public function getWarning(): ?string
    {
        return $this->warning;
    }
    
    public function setInfo(?string $info): self
    {
        $this->info = $info;
        return $this;
    }
    
    public function getInfo(): ?string
    {
        return $this->info;
    }
    
    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }
    
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }
    
    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): ?string
    {
        return $this->id;
    }
    
    public function setBlockType(?string $blockType): self
    {
        $this->blockType = $blockType;
        return $this;
    }
    
    public function getBlockType(): ?string
    {
        return $this->blockType;
    }
}
