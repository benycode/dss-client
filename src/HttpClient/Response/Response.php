<?php

declare(strict_types=1);

namespace DSS\HttpClient\Response;

use DSS\HttpClient\Message\ResponseMediator;

abstract class Response
{   
    protected object $response;
    
    public function __construct(object $response)
    {
        $this->response = $response;
    }
    
    protected function serializate(): array
    {
        return ResponseMediator::getContent($this->response);
    }  
}
