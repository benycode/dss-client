<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion;

final class Certificate
{	
	private array $validationCertificateQualification = [];
    
    private array $constraint = [];
    
    private Conclusion $conclusion;
    
    private string $title;
    
    private string $id;
		
    public function setValidationCertificateQualification(array $validationCertificateQualification): self
    {
        $this->validationCertificateQualification = $validationCertificateQualification;
		return $this;
    }
	
	public function getValidationCertificateQualification(): array
    {
        return $this->validationCertificateQualification;
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
    
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId(): string
    {
        return $this->id;
    }
}
