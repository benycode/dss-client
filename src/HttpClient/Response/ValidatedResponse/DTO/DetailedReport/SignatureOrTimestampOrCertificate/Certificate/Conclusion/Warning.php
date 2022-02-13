<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\SignatureOrTimestampOrCertificate\Certificate\Conclusion;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConclusionWarning;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits\WithConclusionWarning;

final class Warning implements ConclusionWarning
{   
    use WithConclusionWarning;
}
