<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintError;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits\WithConstraintError;

final class Error implements ConstraintError
{   
    use WithConstraintError;
}
