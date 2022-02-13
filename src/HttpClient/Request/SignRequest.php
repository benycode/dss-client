<?php

declare(strict_types=1);

namespace DSS\HttpClient\Request;

use DSS\Client;
use DSS\HttpClient\Response\SignedResponse;

interface SignRequest
{
    public function call(Client $client): SignedResponse;
}
