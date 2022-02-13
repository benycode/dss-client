<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response;

use DSS\HttpClient\Response\Response;
use DSS\HttpClient\Response\ValidatedResponse;
use DSS\HttpClient\Response\ValidatedResponse\ValidatedObject;
use DSS\HttpClient\Response\ValidatedResponse\Traits\WithValidatedCertificateSerialization;

final class ValidatedCertificateResponse extends Response implements ValidatedResponse
{
    use WithvalidatedCertificateSerialization;
    
	public function toDTO(): ValidatedObject {
		
		$serializateResponse = $this->serializate();
        
        return $this->validatedCertificateSerialization($serializateResponse);        
	}
}
