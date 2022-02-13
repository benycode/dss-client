<?php

declare(strict_types=1);

namespace DSS;

use DSS\Entity\Signature;
use DSS\Entity\Certificate;
use DSS\Entity\Digest;
use DSS\Entity\Encryption;
use DSS\Entity\Timestamp;
use DSS\HttpClient\Response\SignedResponse\SignedObject;

interface SignApi
{
    public function sign(?Signature $signature, ?Certificate $certificate, ?Digest $digest, ?Encryption $encryption): self;
	
	public function getDigest(Signature $signature, Certificate $certificate, Digest $digest, Encryption $encryption): self;
	
	public function timestamp(Timestamp $timestamp): self;
	
	public function extend(Signature $signature, Digest $digest, Encryption $encryption): self;
	
	public function withDigest(): self;
	
	public function getResponse(): SignedObject;
}
