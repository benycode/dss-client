<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Constraint;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits\WithConstraintWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintWarning;

final class Warning implements ConstraintWarning
{   
    use WithConstraintWarning;
}
