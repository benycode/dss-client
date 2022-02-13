<?php

declare(strict_types=1);

namespace DSS\HttpClient\Request;

use DSS\Client;
use DSS\Entity\Document;
use DSS\Entity\Digest;
use DSS\Entity\Signature;
use DSS\Entity\Encryption;
use DSS\HttpClient\Request\SignRequest;
use DSS\HttpClient\Response\SignedResponse;
use DSS\HttpClient\Response\OneDocumentSignerResponse;
use DSS\HttpClient\Util\UriBuilder;

final class ExtendRequest implements SignRequest
{
	private Document $document;
	
	private Signature $signature;
	
	private Digest $digest;
	
	private Encryption $encryption;
	
    public function __construct(Document $document, Signature $signature, Digest $digest, Encryption $encryption)
    {
        $this->document = $document;
		$this->signature = $signature;
		$this->digest = $digest;
		$this->encryption = $encryption;
    }
	
	public function call(Client $client): SignedResponse
	{
		$requestBody = $this->builRawdBody();
	
		$uri = $this->buildDataToSignUri();

		$response = $client->getHttpClient()->post($uri, [], $requestBody);

        return new OneDocumentSignerResponse($response);
	}
	
	private function builRawdBody(): string
	{
		return (string)json_encode($this->toArray());
	}
	
	private function toArray(): array {
				
		return [
			'parameters' => [
				'signingCertificate' => null,
				'certificateChain' => [],
				'detachedContents' => null,
				'asicContainerType' => null,
				'signatureLevel' => $this->signature->getSignatureLevel(),
				'signaturePackaging' => null,
				'jwsSerializationType' => null,
				'sigDMechanism' => null,
				'signatureAlgorithm' => $this->signature->getAlgorithm(),
				'digestAlgorithm' => $this->digest->getAlgorithm(),
				'encryptionAlgorithm' => $this->encryption->getAlgorithm(),
				'referenceDigestAlgorithm' => null,
				'maskGenerationFunction' => null,
				'contentTimestamps' => null,
				'contentTimestampParameters' => [
					'digestAlgorithm' => $this->digest->getAlgorithm(),
					'canonicalizationMethod' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
					'timestampContainerForm' => null,
				],
				'signatureTimestampParameters' => [
					'digestAlgorithm' => $this->digest->getAlgorithm(),
					'canonicalizationMethod' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
					'timestampContainerForm' => null,
				],
				'archiveTimestampParameters' => [
					'digestAlgorithm' => $this->digest->getAlgorithm(),
					'canonicalizationMethod' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
					'timestampContainerForm' => null,
				],
				'signWithExpiredCertificate' => null,
				'generateTBSWithoutCertificate' => false,
				'imageParameters' => null,
				'signatureIdToCounterSign' => null,
				'blevelParams' => [
					'trustAnchorBPPolicy' => true,
					'signingDate' => $this->signature->getSigningDate(),
					'claimedSignerRoles' => null,
					'policyId' => null,
					'policyQualifier' => null,
					'policyDescription' => null,
					'policyDigestAlgorithm' => null,
					'policyDigestValue' => null,
					'policySpuri' => null,
					'commitmentTypeIndications' => null,
					'signerLocationPostalAddress' => [],
					'signerLocationPostalCode' => null,
					'signerLocationLocality' => null,
					'signerLocationStateOrProvince' => null,
					'signerLocationCountry' => null,
					'signerLocationStreet' => null,
				],
			],
			'toExtendDocument' => [
				'bytes' => base64_encode($this->document->getBytes()),
				'digestAlgorithm' => null,
				'name' => $this->document->getName(),
			],
		];
	}
	
	private function buildDataToSignUri(): string
    {
        return UriBuilder::build('signature', 'one-document', 'extendDocument');
    }
}