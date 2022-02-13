<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response;

use  DSS\HttpClient\Response\SignedResponse\SignedObject;

interface SignedResponse
{
    public function toDTO(): SignedObject;
}
