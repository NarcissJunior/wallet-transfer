<?php

namespace App\Services;

use App\Http\Requests\Request;

class ValidationService
{
    private array $expectedResponse = ['Autorizado', 'Enviado'];
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function validate($method, $uri)
    {
        $isValid = $this->request->makeRequest($method, $uri);
        return $isValid;
        // return in_array($this->isValid, self::$expectedResponse) ?? false;
    }
}