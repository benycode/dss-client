<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\BasicBuildingBlock\Xcv\Constraint;

use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\Traits\WithConstraintName;
use DSS\HttpClient\Response\ValidatedResponse\DTO\DetailedReport\ConstraintName;

final class Name implements ConstraintName
{   
   use WithConstraintName;
}
