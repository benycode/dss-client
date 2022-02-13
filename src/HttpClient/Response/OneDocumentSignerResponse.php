<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response;

use DSS\HttpClient\Message\ResponseMediator;
use DSS\HttpClient\Response\SignedResponse;
use DSS\HttpClient\Response\SignedResponse\SignedObject;
use DSS\HttpClient\Response\SignedResponse\DTO\SignedDocument;

final class OneDocumentSignerResponse implements SignedResponse
{
	private object $response;
	
    public function __construct(object $response)
    {
        $this->response = $response;
    }
	
	private function serializate(): array
	{
        return ResponseMediator::getContent($this->response);
	}
	
	public function toDTO(): SignedObject {
		
		$serializateResponse = $this->serializate();
		
		return (new SignedDocument())
			->setBytes((string)base64_decode($serializateResponse['bytes'], true))
			->setName($serializateResponse['name'] ?? null)
			->setDigestAlgorithm($serializateResponse['digestAlgorithm'] ?? null)
			;	
	}
}
