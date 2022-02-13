<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Conclusion;

final class Xcv
{   
    private array $subXCV = [];
    
    private array $constraint = [];
    
    private Conclusion $conclusion;
    
    private string $title;
    
    public function setSubXCV(array $subXCV): self
    {
        $this->subXCV = $subXCV;
        return $this;
    }
    
    public function getSubXCV(): array
    {
        return $this->subXCV;
    }
    
    public function appendConstraint(Constraint $constraint): self
    {
        $this->constraint[] = $constraint;
        return $this;
    }
    
    public function getConstraint(): array
    {
        return $this->constraint;
    }
    
    public function setConclusion(Conclusion $conclusion): self
    {
        $this->conclusion = $conclusion;
        return $this;
    }
    
    public function getConclusion(): Conclusion
    {
        return $this->conclusion;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
}
