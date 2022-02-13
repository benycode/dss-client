<?php

declare(strict_types=1);

namespace DSS\Api;

use DSS\Client;
use DSS\ValidateApi;
use DSS\Entity\Certificate;
use DSS\HttpClient\Request\Validate\CertificateValidationRequest;
use DSS\HttpClient\Response\ValidatedResponse\ValidatedObject;

class CertificateCheker implements ValidateApi
{
	private Client $client;
	
	private Certificate $certificate;
	
	public function __construct(Client $client, Certificate $certificate)
    {
		$this->client = $client;
        $this->certificate = $certificate;
    }
	
    public function validate(): self
    {		
        $this->response = (new CertificateValidationRequest($this->certificate))
			->call($this->client)
			->toDTO()
			;
			
		return $this;
	}
	
	public function getResponse(): ValidatedObject {
		return $this->response;
	}
}
