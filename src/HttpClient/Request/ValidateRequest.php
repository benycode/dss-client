<?php

declare(strict_types=1);

namespace DSS\HttpClient\Request;

use DSS\Client;
use DSS\HttpClient\Response\ValidatedResponse;

interface ValidateRequest
{
    public function call(Client $client): ValidatedResponse;
}
