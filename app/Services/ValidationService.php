<?php

namespace App\Services;

use App\Http\Requests\Request;

class ValidationService
{
    private array $expectedResponse = ['Autorizado', 'Enviado'];
    protected Request $request;
    protected $method = 'GET';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    //verificar
    public function validate($step)
    {
        // $autorizado = $this->validateAuth($this->method, 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return $this->validateAuth($this->method, 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        $enviado = $this->validateTransfer($this->method, 'https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');
    }

    private function validateAuth($method, $uri)
    {
        return $this->request->makeRequest($method, $uri);
    }

    private function validateTransfer($method, $uri)
    {
        $this->request->makeRequest($method, $uri);
    }
}