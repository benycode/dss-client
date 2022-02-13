<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate;

use DSS\HttpClient\Response\ValidatedResponse\DTO\Traits\WithDistinguishedName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DiagnosticData\Certificate\DistinguishedName;

final class IssuerDistinguishedName implements DistinguishedName
{	
	use WithDistinguishedName;
}
