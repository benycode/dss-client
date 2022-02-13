<?php

declare(strict_types=1);

namespace DSS;

use DSS\Entity\Signature;
use DSS\Entity\Certificate;
use DSS\Entity\Digest;
use DSS\Entity\Encryption;
use DSS\Entity\Timestamp;
use DSS\HttpClient\Response\ValidatedResponse\ValidatedObject;

interface ValidateApi
{
    public function validate(): self;
    
    public function getResponse(): ValidatedObject;
}
