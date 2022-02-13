<?php

declare(strict_types=1);

namespace DSS\HttpClient\Request\Validate;

use DSS\Client;
use DSS\Entity\Document;
use DSS\Entity\Digest;
use DSS\Entity\Signature;
use DSS\Entity\Certificate;
use DSS\Entity\Encryption;
use DSS\HttpClient\Request\ValidateRequest;
use DSS\HttpClient\Response\ValidatedCertificateResponse;
use DSS\HttpClient\Response\ValidatedResponse;
use DSS\HttpClient\Util\UriBuilder;

final class CertificateValidationRequest implements ValidateRequest
{
	private Certificate $certificate;	
	
    public function __construct(Certificate $certificate)
    {
		$this->certificate = $certificate;
    }
	
	public function call(Client $client): ValidatedResponse
	{
		$requestBody = $this->builRawdBody();
	
		$uri = $this->buildValidateCertificateUri();

		$response = $client->getHttpClient()->post($uri, [], $requestBody);

        return new ValidatedCertificateResponse($response);
	}
	
	private function builRawdBody(): string
	{
		return (string)json_encode($this->toArray());
	}
	
	private function toArray(): array {
		
		$chains = [];
		
		foreach($this->certificate->getChains() as $chain){
			$chains[]['encodedCertificate'] = base64_encode($chain);
		}
		
		return [
			'certificate' => [
				'encodedCertificate' => base64_encode($this->certificate->getCertificate()),
			],
			'certificateChain' => $chains,
			'validationTime' => null,
			'tokenExtractionStrategy' => 'NONE',
		];
	}
	
	private function buildValidateCertificateUri(): string
    {
        return UriBuilder::build('certificate-validation', 'validateCertificate');
    }
}