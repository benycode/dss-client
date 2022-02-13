<?php

declare(strict_types=1);

namespace DSS\Api\Sign;

use DSS\Client;
use DSS\SignApi;
use DSS\Entity\Signature;
use DSS\Entity\Certificate;
use DSS\Entity\Document;
use DSS\Entity\Digest;
use DSS\Entity\Timestamp;
use DSS\Entity\Encryption;
use DSS\HttpClient\Request\DataToSignRequest;
use DSS\HttpClient\Request\ExtendRequest;
use DSS\HttpClient\Request\Sign\OneDocumentSignerRequest;
use DSS\HttpClient\Request\Sign\TimestampRequest;
use DSS\HttpClient\Response\SignedResponse\SignedObject;

class OneDocumentSigner implements SignApi
{
	private Client $client;
	
	private Signature $signature;
	
	private Certificate $certificate;
		
	private Document $document;
	
	private Digest $digest;
	
	private Encryption $encryption;
	
	private SignedObject $response;
	
	public function __construct(Client $client, Document $document)
    {
		$this->client = $client;
        $this->document = $document;
    }
	
    public function sign(?Signature $signature = null, ?Certificate $certificate = null, ?Digest $digest, ?Encryption $encryption): self
    {
		if(!is_null($signature)){
			$this->signature = $signature;
		}
		
		if(!is_null($certificate)){
			$this->certificate = $certificate;
		}
		
		if(!is_null($digest)){
			$this->digest = $digest;
		}
		
		if(!is_null($encryption)){
			$this->encryption = $encryption;
		}
		
        $this->response = (new OneDocumentSignerRequest($this->document, $this->signature, $this->certificate, $this->digest, $this->encryption))
			->call($this->client)
			->toDTO()
			;
			
		return $this;
    }
	
	public function getDigest(Signature $signature, Certificate $certificate, Digest $digest, Encryption $encryption): self
    {
		$this->signature = $signature;
		$this->certificate = $certificate;
		$this->digest = $digest;
		$this->encryption = $encryption;
		
        $this->response = (new DataToSignRequest($this->document, $this->signature, $this->certificate, $this->digest, $this->encryption))
			->call($this->client)
			->toDTO()
			;
			
		return $this;
    }
	
	public function timestamp(Timestamp $timestamp): self
    {
        $this->response = (new TimestampRequest($this->document, $timestamp))
			->call($this->client)
			->toDTO()
			;
			
		return $this;
    }
	
	public function extend(Signature $signature, Digest $digest, Encryption $encryption): self
    {
		$this->digest = $digest;
		$this->encryption = $encryption;
		
        $this->response = (new ExtendRequest($this->document, $signature, $this->digest, $this->encryption))
			->call($this->client)
			->toDTO()
			;
			
		return $this;
    }
	
	public function withDigest(): self
	{
		$this->signature->setValue($this->response->getBytes());
		return $this;
	}
	
	public function getResponse(): SignedObject {
		return $this->response;
	}
}
