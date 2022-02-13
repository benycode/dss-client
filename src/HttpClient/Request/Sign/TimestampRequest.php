<?php

declare(strict_types=1);

namespace DSS\HttpClient\Request\Sign;

use DSS\Client;
use DSS\Entity\Document;
use DSS\Entity\Timestamp;
use DSS\HttpClient\Request\SignRequest;
use DSS\HttpClient\Response\SignedResponse;
use DSS\HttpClient\Response\OneDocumentSignerResponse;
use DSS\HttpClient\Util\UriBuilder;

final class TimestampRequest implements SignRequest
{
	private Document $document;
	
	private Timestamp $timestamp;
	
    public function __construct(Document $document, Timestamp $timestamp)
    {
        $this->document = $document;
		$this->timestamp = $timestamp;
    }
	
	public function call(Client $client): SignedResponse
	{
		$requestBody = $this->builRawdBody();
		
		$uri = $this->buildDocumentSignUri();

		$response = $client->getHttpClient()->post($uri, [], $requestBody);

        return new OneDocumentSignerResponse($response);
	}
	
	private function builRawdBody(): string
	{
		return (string)json_encode($this->toArray());
	}
	
	private function toArray(): array {
		
		return [
			'timestampParameters' => [
				'digestAlgorithm' => $this->timestamp->getDigestAlgorithm(),
				'canonicalizationMethod' => 'http://www.w3.org/2001/10/xml-exc-c14n#',
				'timestampContainerForm' => $this->timestamp->getTimestampContainerForm(),
			],
			'toTimestampDocument' => [
				'bytes' => base64_encode($this->document->getBytes()),
				'digestAlgorithm' => null,
				'name' => $this->document->getName(),
			],
		];
	}
	
	private function buildDocumentSignUri(): string
    {
        return UriBuilder::build('signature', 'one-document', 'timestampDocument');
    }
}