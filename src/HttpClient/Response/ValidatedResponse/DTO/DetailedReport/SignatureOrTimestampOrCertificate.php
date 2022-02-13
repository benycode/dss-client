<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate;

final class SignatureOrTimestampOrCertificate
{	
	private array $certificate = [];
		
    public function appendCertificate(Certificate $certificate): self
    {
        $this->certificate[] = $certificate;
		return $this;
    }
	
	public function getCertificate(): array
    {
        return $this->certificate;
    }
}
