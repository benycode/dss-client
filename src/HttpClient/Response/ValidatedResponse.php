<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response;

use  DSS\HttpClient\Response\ValidatedResponse\ValidatedObject;

interface ValidatedResponse
{
    public function toDTO(): ValidatedObject;
}
