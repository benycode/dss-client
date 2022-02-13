<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Conclusion;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConclusionError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits\WithConclusionError;

final class Error implements ConclusionError
{   
    use WithConclusionError;
}
